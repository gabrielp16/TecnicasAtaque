<form class="form-inline search-component float-right" action="search.php" method="post" name="form1">
    <div class="input-group">
        <label for="order">Buscar por:</label>
        <input class="form-control search-input" type="search" name="search" placeholder="Buscar" aria-label="Search"
            value="<?php echo $search; ?>">
        <select name="search-selector" class="form-control search-selector" id="search-selector">
            <option value="products.name"
                <?php if($search_selector == 'products.name'){ echo ' selected="selected"'; } ?>>
                Producto</option>
            <option value="products.qty"
                <?php if($search_selector == 'products.qty'){ echo ' selected="selected"'; } ?>>
                Cantidad</option>
            <option value="products.price"
                <?php if($search_selector == 'products.price'){ echo ' selected="selected"'; } ?>>
                Precio</option>
        </select>
        <label for="order">Ordenar por:</label>
        <select name="order-type-selector" class="form-control search-selector" id="order-type-selector">
            <option value="products.name" <?php if($order_type == 'products.name'){ echo ' selected="selected"'; } ?>>
                Producto</option>
            <option value="products.qty" <?php if($order_type == 'products.qty'){ echo ' selected="selected"'; } ?>>
                Cantidad</option>
            <option value="products.price" <?php if($order_type == 'products.price'){ echo ' selected="selected"'; } ?>>
                Precio</option>
            <option value="products.expiration_date"
                <?php if($order_type == 'products.expiration_date'){ echo ' selected="selected"'; } ?>>Fecha de
                expiracion</option>
        </select>
        <select name="order-selector" class="form-control search-selector" id="order-selector">
            <option value="ASC" <?php if($order == 'ASC'){ echo ' selected="selected"'; } ?>>
                Ascendente
            </option>
            <option value="DESC" <?php if($order == 'DESC'){ echo ' selected="selected"'; } ?>>
                Descendente
            </option>
        </select>
        <button class="btn btn btn-success my-0" type="submit" name="submit_search">Buscar</button>
    </div>
</form>