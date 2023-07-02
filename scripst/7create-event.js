// Importar classes necessárias
import Event from './Event';

// Selecionar elementos
const createEventForm = document.getElementById('create-event-form');
const titleInput = document.getElementById('title-input');
const descriptionInput = document.getElementById('description-input');
const dateInput = document.getElementById('date-input');
const timeInput = document.getElementById('time-input');
const locationInput = document.getElementById('location-input');
const categoryInput = document.getElementById('category-input');
const priceInput = document.getElementById('price-input');

// Adicionar evento de envio ao formulário
createEventForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const title = titleInput.value;
  const description = descriptionInput.value;
  const date = dateInput.value;
  const time = timeInput.value;
  const location = locationInput.value;
  const category = categoryInput.value;
  const price = parseFloat(priceInput.value);

  // Criar nova instância do evento
  const newEvent = new Event(title, description, date, time, location, category, price);

  console.log('Novo evento criado:', newEvent);
});
