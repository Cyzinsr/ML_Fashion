
document.addEventListener("DOMContentLoaded", () => {
    fetch('listar_produtos.php')
        .then(response => response.json())
        .then(data => {
            const ul = document.getElementById('lista-produtos');
            const msg = document.getElementById('mensagem');
            if (data.length === 0) {
                msg.textContent = "Nenhum produto cadastrado.";
            } else {
                msg.remove();
                data.forEach(prod => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <strong>${prod.nome}</strong><br>
                        R$ ${parseFloat(prod.preco).toFixed(2)}<br>
                        <img src="${prod.imagem}" width="120">
                    `;
                    ul.appendChild(li);
                });
            }
        })
        .catch(err => {
            document.getElementById('mensagem').textContent = "Erro ao carregar produtos.";
        });
});
