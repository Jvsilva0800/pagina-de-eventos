<!DOCTYPE html>
<html>
<head>
  <title>Sistema de Cadastro de Eventos - Lista de Eventos</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Sistema de Cadastro de Eventos - Lista de Eventos</h1>
  <form id="filter-form" method="POST">
    <input type="text" name="search-input" placeholder="Pesquisar evento">
    <select name="category-select">
      <option value="">Todas as categorias</option>
      <option value="1">Categoria 1</option>
      <option value="2">Categoria 2</option>
      <option value="3">Categoria 3</option>
    </select>
    <button type="submit" name="filter-button">Filtrar</button>
  </form>

  <div id="event-list">
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $searchTerm = $_POST['search-input'];
        $selectedCategory = $_POST['category-select'];

      
        filterEvents($searchTerm, $selectedCategory);
      }

      
      function filterEvents($searchTerm, $category) {
      
        $apiUrl = sprintf('/api/events?search=%s&category=%s', urlencode($searchTerm), urlencode($category));
        $response = file_get_contents($apiUrl);

        if ($response === false) {
          echo 'Erro ao buscar eventos';
          return;
        }

        $eventsData = json_decode($response, true);

    
        foreach ($eventsData as $eventData) {
          echo '<div class="event-item">';
          echo '<h3>' . $eventData['title'] . '</h3>';
          echo '<p>' . $eventData['description'] . '</p>';
          echo '<p>Date: ' . $eventData['date'] . '</p>';
          echo '<p>Time: ' . $eventData['time'] . '</p>';
          echo '<p>Location: ' . $eventData['location'] . '</p>';
          echo '<p>Category: ' . $eventData['category'] . '</p>';
          echo '<p>Price: ' . $eventData['price'] . '</p>';
          echo '</div>';
        }
      }
    ?>
  </div>

  <script src="2event_list.js"></script>
</body>
</html>
