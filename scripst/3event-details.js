// Importar a classe Event
import Event from './Event';

// Selecionar elementos
const eventTitle = document.querySelector('#event-details h2');
const eventDescription = document.querySelector('#event-details p:nth-of-type(1)');
const eventDate = document.querySelector('#event-details p:nth-of-type(2)');
const eventLocation = document.querySelector('#event-details p:nth-of-type(3)');
const eventCategory = document.querySelector('#event-details p:nth-of-type(4)');
const registrationButton = document.getElementById('registration-button');

// Simulação de dados do evento
const eventData = {
  title: 'Título do Evento',
  description: 'Descrição do Evento',
  date: '01/01/2023',
  location: 'Local do Evento',
  category: 'Categoria do Evento'
};

// Atualizar os detalhes do evento na página
eventTitle.textContent = eventData.title;
eventDescription.textContent = eventData.description;
eventDate.textContent = `Data: ${eventData.date}`;
eventLocation.textContent = `Local: ${eventData.location}`;
eventCategory.textContent = `Categoria: ${eventData.category}`;

// Adicionar evento de inscrição
registrationButton.addEventListener('click', function() {
  
  console.log('Inscrição realizada com sucesso!');
});
