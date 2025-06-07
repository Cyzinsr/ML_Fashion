
document.addEventListener("DOMContentLoaded", () => {
    fetch('listar_produtos.php')
        .then(response => response.json())
        .then(data => {
            const ul = document.getElementById('lista-produtos');
            data.forEach(prod => {
                const li = document.createElement('li');
                li.innerHTML = `ID: ${prod.id} | Nome: ${prod.nome} | Preço: R$ ${parseFloat(prod.preco).toFixed(2)} <br> <img src="${prod.imagem}" width="100">`;
                ul.appendChild(li);
            });
        })
        .catch(err => alert("Erro ao carregar produtos"));
});
