const btnCart = document.querySelector('.container-cart-icon');
const containerCartProducts = document.querySelector('.container-cart-products');
const rowProduct = document.querySelector('.row-product');
const productsList = document.querySelector('.container-items');
let allProducts = [];
const valorTotal = document.querySelector('.total-pagar');
const countProducts = document.querySelector('#contador-productos');

btnCart.addEventListener('click', () => {
    containerCartProducts.classList.toggle('hidden-cart');
});

productsList.addEventListener('click', e => {
    if (e.target.classList.contains('btn-add-cart')) {
        const product = e.target.parentElement;
        const infoProduct = {
            quantity: 1,
            title: product.querySelector('h2').textContent,
            price: parseFloat(product.querySelector('.price').textContent.slice(1))
        };

        const exists = allProducts.some(product => product.title === infoProduct.title);

        if (exists) {
            const products = allProducts.map(product => {
                if (product.title === infoProduct.title) {
                    product.quantity++;
                }
                return product;
            });
            allProducts = [...products];
        } else {
            allProducts = [...allProducts, infoProduct];
        }

        showHTML();
    }
});

rowProduct.addEventListener('click', e => {
    if (e.target.classList.contains('icon-close')) {
        const product = e.target.parentElement;
        const title = product.querySelector('.titulo-producto-carrito').textContent;
        allProducts = allProducts.filter(product => product.title !== title);
        showHTML();
    }
});

function showHTML() {
    if (!allProducts.length) {
        rowProduct.innerHTML = `<p class="cart-empty">El carrito está vacío</p>`;
    } else {
        rowProduct.innerHTML = "";
        let total = 0;
        let totalOfProducts = 0;

        allProducts.forEach(product => {
            const containerProduct = document.createElement('div');
            containerProduct.classList.add('cart-product');
            containerProduct.innerHTML = `
                <div class="info-cart-product">
                    <span class="cantidad-producto-carrito">${product.quantity}</span>
                    <p class="titulo-producto-carrito">${product.title}</p>
                    <span class="precio-producto-carrito">$${product.quantity * product.price}</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-close">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;
            rowProduct.appendChild(containerProduct);

            total += product.quantity * product.price;
            totalOfProducts += product.quantity;
        });

        valorTotal.textContent = `$${total}`;
        countProducts.textContent = totalOfProducts;
    }
}

function generarTicket() {
    const ticketWindow = window.open('', 'Ticket', 'width=400,height=600');
    ticketWindow.document.write('<html><head><title>Ticket de Compra</title>');
    ticketWindow.document.write('<link rel="stylesheet" href="styles.css" />');
    ticketWindow.document.write('</head><body>');
    ticketWindow.document.write('<h1>Ticket de Compra</h1>');
    ticketWindow.document.write('<div class="row-product">');
    
    allProducts.forEach(product => {
        ticketWindow.document.write(`
            <div class="cart-product">
                <div class="info-cart-product">
                    <span class="cantidad-producto-carrito">${product.quantity}</span>
                    <p class="titulo-producto-carrito">${product.title}</p>
                    <span class="precio-producto-carrito">$${product.quantity * product.price}</span>
                </div>
            </div>
        `);
    });

    ticketWindow.document.write('</div>');
    ticketWindow.document.write(`<div class="cart-total">
        <h3>Total:</h3>
        <span class="total-pagar">$${valorTotal.textContent.slice(1)}</span>
    </div>`);
    ticketWindow.document.write('</body></html>');
    ticketWindow.document.close();
    ticketWindow.print();
}

// Ejemplo de agregar una consulta médica al carrito y al ticket
const precioConsulta = 150;

function agregarConsulta() {
    const consulta = {
        quantity: 1,
        title: 'Consulta Médica',
        price: precioConsulta
    };

    allProducts.push(consulta);
    showHTML();
}

function resetearCarrito() {
    allProducts = [];
    showHTML();
}
