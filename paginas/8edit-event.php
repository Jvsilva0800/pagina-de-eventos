<!DOCTYPE html>
<html>
<head>
  <title>Sistema de Cadastro de Eventos - Editar Evento</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Sistema de Cadastro de Eventos - Editar Evento</h1>
  
  <form id="edit-event-form">
    <input type="text" id="title-input" placeholder="Título">
    <textarea id="description-input" placeholder="Descrição"></textarea>
    <input type="date" id="date-input">
    <input type="time" id="time-input">
    <input type="text" id="location-input" placeholder="Localização">
    <input type="text" id="category-input" placeholder="Categoria">
    <input type="number" id="price-input" placeholder="Preço">
    <button id="update-event-button">Atualizar Evento</button>
  </form>

  <script src="8edit-event.js"></script>
</body>
</html>
