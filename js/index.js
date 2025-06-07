document.addEventListener("DOMContentLoaded", () => {
    const produtosSimulados = [
        {
            nome: "Vestido Longo Floral",
            preco: 149.90,
            imagem: "https://via.placeholder.com/120x150?text=Vestido+1"
        },
        {
            nome: "Conjunto Saia e Blusa",
            preco: 179.90,
            imagem: "https://via.placeholder.com/120x150?text=Conjunto"
        },
        {
            nome: "Vestido Midi Azul",
            preco: 129.90,
            imagem: "https://via.placeholder.com/120x150?text=Vestido+2"
        }
    ];

    const ul = document.getElementById('lista-produtos');
    const msg = document.getElementById('mensagem');
    msg.remove();

    produtosSimulados.forEach(prod => {
        const li = document.createElement('li');
        li.innerHTML = `
            <strong>${prod.nome}</strong><br>
            R$ ${prod.preco.toFixed(2)}<br>
            <img src="${prod.imagem}" width="120">
        `;
        ul.appendChild(li);
    });
});
