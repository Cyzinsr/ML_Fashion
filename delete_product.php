
<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    if (!$id) {
        echo "ID é obrigatório.";
        exit;
    }

    // Buscar imagem para excluir
    $stmt = $conn->prepare("SELECT imagem FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }

    // Excluir produto
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Excluir imagem do servidor
        if ($produto['imagem'] && file_exists($produto['imagem'])) {
            unlink($produto['imagem']);
        }
        echo "Produto removido com sucesso.";
    } else {
        echo "Erro ao remover produto.";
    }
}
?>
