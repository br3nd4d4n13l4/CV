<!DOCTYPE html>
<html lang="es">
<head>
    <title>Farmacia</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content=""/>
    <meta name="copyright" content="Desarrollo de aplicaciones para la web"/>
    <meta name="keywords" content="HTML, JavaScript, carrito de compras, svg, gráficas vectoriales escalables"/>
    <meta name="description" content="carrito de compras"/>
    <meta name="robots" content="index"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Matias Medina Danna Lizbeth">
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <h1>Farmacia</h1>
        <div class="container-icon">
            <div class="container-cart-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-cart">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
                <div class="count-products">
                    <span id="contador-productos">0</span>
                </div>
            </div>
            <div class="container-cart-products hidden-cart">
                <div class="row-product"></div>
                <div class="cart-total">
                    <h3>Total:</h3>
                    <span class="total-pagar">$0</span>
                </div>
                <button class="btn-generate-ticket" onclick="generarTicket()">Generar Ticket</button>
            </div>
        </div>
    </header>
    <div class="container-items">
        <div class="item">
            <figure><img src="PARASETAMOL.jfif" alt="producto"/></figure>
            <div class="info-product">
                <h2>parasetamol 500</h2>
                <p class="price">$25</p>
                <button class="btn-add-cart"  onclick="generarTicket()">Añadir al carrito</button>
            </div>
        </div>
        <div class="item">
            <figure><img src="CLONAZEPAM.jfif" alt="producto"/></figure>
            <div class="info-product">
                <h2>Clonazepam</h2>
                <p class="price">$82</p>
                <button class="btn-add-cart"  onclick="generarTicket()">Añadir al carrito</button>
            </div>
        </div>
        <div class="item">
            <figure><img src="ASPIRINA.jfif" alt="producto"/></figure>
            <div class="info-product">
                <h2>Aspirina 100</h2>
                <p class="price">$275</p>
                <button class="btn-add-cart"  onclick="generarTicket()">Añadir al carrito</button>
            </div>
        </div>
        <div class="item">
            <figure><img src="AGRIFEN.jfif" alt="producto"/></figure>
            <div class="info-product">
                <h2>Agrifen</h2>
                <p class="price">$27</p>
                <button class="btn-add-cart"  onclick="generarTicket()">Añadir al carrito</button>
            </div>
        </div>
        <div class="item">
            <figure><img src="AMOXICILINA.jfif" alt="producto"/></figure>
            <div class="info-product">
                <h2>Amoxicilina</h2>
                <p class="price">$367</p>
                <button class="btn-add-cart"  onclick="generarTicket()">Añadir al carrito</button>
            </div>
        </div>
    </div>
    <script src="index.js"></script>
</body>
</html>