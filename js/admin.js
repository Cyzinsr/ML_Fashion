document.getElementById("form-produto").addEventListener("submit", function (e) {
  e.preventDefault();

  const nome = document.getElementById("nome").value;
  const preco = parseFloat(document.getElementById("preco").value);
  const imagem = document.getElementById("imagem").value;

  const li = document.createElement("li");
  li.innerHTML = `
    <strong>${nome}</strong><br>
    R$ ${preco.toFixed(2)}<br>
    <img src="${imagem}" width="120" />
  `;

  document.getElementById("lista-previa").appendChild(li);

  // Limpa os campos
  this.reset();
});
