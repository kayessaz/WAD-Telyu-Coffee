<form method="POST" action="{{ route('menu.store') }}">
    @csrf
    <div>
        <label for="name">Menu Name</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label for="price">Price</label>
        <input type="number" name="price" required>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" required></textarea>
    </div>
    <button type="submit">Add Menu</button>
</form>
