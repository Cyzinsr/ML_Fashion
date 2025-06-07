
<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $imagem = '';

    if (!$nome || !$preco) {
        echo "Nome e preço são obrigatórios.";
        exit;
    }

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            $imagem = $target_file;
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    }

    $stmt = $conn->prepare("INSERT INTO produtos (nome, preco, imagem) VALUES (:nome, :preco, :imagem)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':imagem', $imagem);

    if ($stmt->execute()) {
        echo "Produto adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar produto.";
    }
}
?>
