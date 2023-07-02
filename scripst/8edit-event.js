// Importar classes necessárias
import Event from './Event';

// Selecionar elementos
const editEventForm = document.getElementById('edit-event-form');
const titleInput = document.getElementById('title-input');
const descriptionInput = document.getElementById('description-input');
const dateInput = document.getElementById('date-input');
const timeInput = document.getElementById('time-input');
const locationInput = document.getElementById('location-input');
const categoryInput = document.getElementById('category-input');
const priceInput = document.getElementById('price-input');

// Simulação de dados do evento existente
const eventData = {
  title: 'Título do Evento',
  description: 'Descrição do Evento',
  date: '2023-01-01',
  time: '12:00',
  location: 'Local do Evento',
  category: 'Categoria do Evento',
  price: 10.0
};

// Preencher os campos do formulário com os dados do evento existente
titleInput.value = eventData.title;
descriptionInput.value = eventData.description;
dateInput.value = eventData.date;
timeInput.value = eventData.time;
locationInput.value = eventData.location;
categoryInput.value = eventData.category;
priceInput.value = eventData.price;

// Adicionar evento de envio ao formulário
editEventForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const title = titleInput.value;
  const description = descriptionInput.value;
  const date = dateInput.value;
  const time = timeInput.value;
  const location = locationInput.value;
  const category = categoryInput.value;
  const price = parseFloat(priceInput.value);

  // Criar instância do evento atualizado
  const updatedEvent = new Event(title, description, date, time, location, category, price);

  console.log('Evento atualizado:', updatedEvent);
});
