const busca = document.getElementById('busca');
const produtos = Array.from(document.querySelectorAll('.produto-card'));
const ordenarPreco = document.getElementById('ordenar-preco');

// Função para pegar valores marcados de um grupo de checkboxes
function getCheckedValues(classe) {
  return Array.from(document.querySelectorAll('.' + classe + ':checked')).map(cb => cb.value);
}

function filtrarProdutos() {
  const textoBusca = busca.value.toLowerCase();
  const materiais = getCheckedValues('material-checkbox');
  const corpecas = getCheckedValues('corpeca-checkbox');
  const corpedras = getCheckedValues('corpedra-checkbox');
  const tamanhos = getCheckedValues('tamanho-checkbox');
  const colecoes = getCheckedValues('colecao-checkbox');
  const promocoes = getCheckedValues('promocao-checkbox');
  const disponibilidades = getCheckedValues('disponibilidade-checkbox');
  const hipos = getCheckedValues('hipo-checkbox');
  const banhos = getCheckedValues('banho-checkbox');

  produtos.forEach(produto => {
    const nome = produto.dataset.nome.toLowerCase();
    const mostra =
      (materiais.length === 0 || materiais.includes(produto.dataset.material)) &&
      (corpecas.length === 0 || corpecas.includes(produto.dataset.corpeca)) &&
      (corpedras.length === 0 || corpedras.includes(produto.dataset.corpedra)) &&
      (tamanhos.length === 0 || tamanhos.includes(produto.dataset.tamanho)) &&
      (colecoes.length === 0 || colecoes.includes(produto.dataset.colecao)) &&
      (promocoes.length === 0 || promocoes.includes(produto.dataset.promocao)) &&
      (disponibilidades.length === 0 || disponibilidades.includes(produto.dataset.disponibilidade)) &&
      (hipos.length === 0 || hipos.includes(produto.dataset.hipo)) &&
      (banhos.length === 0 || banhos.includes(produto.dataset.banho)) &&
      nome.includes(textoBusca);

    produto.style.display = mostra ? "block" : "none";
  });
}

// Ordenação por preço
function ordenarProdutos() {
  const ordem = ordenarPreco.value;
  const grid = document.getElementById('produtos-grid');
  const visiveis = produtos.filter(p => p.style.display !== "none");
  visiveis.sort((a, b) => {
    const pa = parseFloat(a.dataset.preco);
    const pb = parseFloat(b.dataset.preco);
    return ordem === "asc" ? pa - pb : pb - pa;
  });
  visiveis.forEach(p => grid.appendChild(p));
}

document.querySelectorAll('.filtros-lateral input[type="checkbox"]').forEach(cb => cb.addEventListener('change', () => {
  filtrarProdutos();
  ordenarProdutos();
}));
busca.addEventListener('input', () => {
  filtrarProdutos();
  ordenarProdutos();
});
ordenarPreco.addEventListener('change', ordenarProdutos);

// Inicializa
filtrarProdutos();

document.querySelectorAll('.filtro-titulo').forEach(btn => {
  btn.addEventListener('click', function() {
    const dropdown = this.parentElement;
    dropdown.classList.toggle('open');
    // Fecha outros dropdowns
    document.querySelectorAll('.filtro-dropdown').forEach(other => {
      if (other !== dropdown) other.classList.remove('open');
    });
  });
});

// Fecha o dropdown se clicar fora
document.addEventListener('click', function(e) {
  if (!e.target.closest('.filtro-dropdown')) {
    document.querySelectorAll('.filtro-dropdown').forEach(drop => drop.classList.remove('open'));
  }
});

document.getElementById('btn-resetar-filtros').addEventListener('click', function() {
  // Limpa busca
  document.getElementById('busca').value = '';
  // Desmarca todos os checkboxes
  document.querySelectorAll('.filtros-lateral input[type="checkbox"]').forEach(cb => cb.checked = false);
  // Reseta select de preço
  document.getElementById('ordenar-preco').value = '';
  // Fecha todos os dropdowns (se estiver usando)
  document.querySelectorAll('.filtro-dropdown').forEach(drop => drop.classList.remove('open'));
  // Atualiza a filtragem
  if (typeof filtrarProdutos === 'function') filtrarProdutos();
  if (typeof ordenarProdutos === 'function') ordenarProdutos();
});