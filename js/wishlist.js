// wishlist.js - Gerenciamento de lista de desejos
function getWishlist() {
  return JSON.parse(localStorage.getItem('wishlist')) || [];
}

function salvarWishlist(wishlist) {
  localStorage.setItem('wishlist', JSON.stringify(wishlist));
}

function adicionarWishlist(produto) {
  let wishlist = getWishlist();
  if (!wishlist.find(item => item.id === produto.id)) {
    wishlist.push(produto);
    salvarWishlist(wishlist);
    alert('Produto adicionado à lista de desejos!');
  } else {
    alert('Produto já está na lista de desejos.');
  }
}

function removerWishlist(id) {
  let wishlist = getWishlist();
  wishlist = wishlist.filter(item => item.id !== id);
  salvarWishlist(wishlist);
  renderizarWishlist();
}

function renderizarWishlist() {
  const wishlist = getWishlist();
  const container = document.getElementById('wishlist-container');
  if (!container) return;

  container.innerHTML = '';
  if (wishlist.length === 0) {
    container.innerHTML = '<p>Sua lista de desejos está vazia.</p>';
    return;
  }

  wishlist.forEach(item => {
    container.innerHTML += `
      <div class="wishlist-item">
        <img src="${item.img}" alt="${item.nome}" style="width:60px;">
        <div>
          <strong>${item.nome}</strong><br>
          R$ ${item.preco.toFixed(2).replace('.',',')}
          <button onclick="removerWishlist(${item.id})">Remover</button>
          <button onclick="adicionarAoCarrinho(${JSON.stringify(item).replace(/"/g, '&quot;')})">Adicionar ao Carrinho</button>
        </div>
      </div>
    `;
  });
}

// Função para adicionar ao carrinho (integrar com carrinho existente)
function adicionarAoCarrinho(produto) {
  let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
  carrinho.push({...produto, qtd: 1});
  localStorage.setItem('carrinho', JSON.stringify(carrinho));
  alert('Produto adicionado ao carrinho!');
}