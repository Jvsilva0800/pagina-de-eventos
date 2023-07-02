import Event from './Event';
// Selecionar elementos
const filterForm = document.getElementById('filter-form');
const searchInput = document.getElementById('search-input');
const categorySelect = document.getElementById('category-select');
const eventList = document.getElementById('event-list');

// Adicionar evento de envio ao formulário de filtro
filterForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const searchTerm = searchInput.value;
  const selectedCategory = categorySelect.value;
  // Realizar ação de filtro com os termos digitados
  filterEvents(searchTerm, selectedCategory);
});

// Função para filtrar eventos
function filterEvents(searchTerm, category) {
  
  fetch(`/api/events?search=${searchTerm}&category=${category}`)
    .then(response => response.json())
    .then(eventsData => {
      // Limpar a lista de eventos
      eventList.innerHTML = '';

      // Criar instâncias dos eventos a partir dos dados retornados pela API
      const events = eventsData.map(eventData => {
        // Criar instância da classe Event
        const event = new Event(
          eventData.id,
          eventData.title,
          eventData.description,
          eventData.date,
          eventData.time,
          eventData.location,
          eventData.category,
          eventData.price,
          eventData.images
        );

        // Retornar a instância do evento
        return event;
      });

      // Exibir os eventos encontrados na lista
      events.forEach(event => {
        const eventItem = document.createElement('div');
        eventItem.classList.add('event-item');
        eventItem.innerHTML = `
          <h3>${event.getTitle()}</h3>
          <p>${event.getDescription()}</p>
          <p>Date: ${event.getDate()}</p>
          <p>Time: ${event.getTime()}</p>
          <p>Location: ${event.getLocation()}</p>
          <p>Category: ${event.getCategory()}</p>
          <p>Price: ${event.getPrice()}</p>
        `;
        eventList.appendChild(eventItem);
      });
    })
    .catch(error => {
      console.error('Erro ao buscar eventos:', error);
    });
}
