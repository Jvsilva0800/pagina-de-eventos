<!DOCTYPE html>
<html>
<head>
  <title>Sistema de Cadastro de Eventos - Criar Evento</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Sistema de Cadastro de Eventos - Criar Evento</h1>

  <form id="create-event-form">
    <input type="text" id="title-input" placeholder="Título">
    <textarea id="description-input" placeholder="Descrição"></textarea>
    <input type="date" id="date-input">
    <input type="time" id="time-input">
    <input type="text" id="location-input" placeholder="Localização">
    <input type="text" id="category-input" placeholder="Categoria">
    <input type="number" id="price-input" placeholder="Preço">
    <button id="create-event-button">Criar Evento</button>
  </form>

  <script src="7create-event.js"></script>
</body>
</html>
