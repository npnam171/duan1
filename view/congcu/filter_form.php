<form action="index.php?action=filterByPrice" method="post">
    <label for="minPrice">Giá thấp nhất:</label>
    <input type="number" id="minPrice" name="minPrice" required>
    
    <label for="maxPrice">Giá cao nhất:</label>
    <input type="number" id="maxPrice" name="maxPrice" required>
    
    <button type="submit">Lọc</button>