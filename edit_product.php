
<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';

    if (!$id || !$nome || !$preco) {
        echo "ID, nome e preço são obrigatórios.";
        exit;
    }

    // Buscar imagem antiga
    $stmt = $conn->prepare("SELECT imagem FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }

    $imagem = $produto['imagem'];

    // Se nova imagem foi enviada, fazer upload e substituir
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            $imagem = $target_file;
            // Opcional: remover imagem antiga do servidor
            if ($produto['imagem'] && file_exists($produto['imagem'])) {
                unlink($produto['imagem']);
            }
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    }

    $stmt = $conn->prepare("UPDATE produtos SET nome = :nome, preco = :preco, imagem = :imagem WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar produto.";
    }
}
?>
