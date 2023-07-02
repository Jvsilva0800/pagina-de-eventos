// Importar classes necessárias
import Event from './Event';

// Selecionar elementos
const eventList = document.getElementById('event-list');
const createEventButton = document.getElementById('create-event-button');

// Simulação de dados de eventos
const eventData = [
  {
    title: 'Evento 1',
    description: 'Descrição do Evento 1',
    date: '2023-01-01',
    location: 'Local do Evento 1',
    category: 'Categoria 1'
  },
  {
    title: 'Evento 2',
    description: 'Descrição do Evento 2',
    date: '2023-02-01',
    location: 'Local do Evento 2',
    category: 'Categoria 2'
  },
  {
    title: 'Evento 3',
    description: 'Descrição do Evento 3',
    date: '2023-03-01',
    location: 'Local do Evento 3',
    category: 'Categoria 3'
  }
];

// Exibir a lista de eventos no painel administrativo
eventData.forEach(eventData => {
  const event = new Event(eventData.title, eventData.description, eventData.date, eventData.location, eventData.category);
  const listItem = document.createElement('li');
  listItem.textContent = event.getTitle();
  eventList.appendChild(listItem);
});

// Adicionar evento de clique ao botão "Criar Novo Evento"
createEventButton.addEventListener('click', function() {
  
  console.log('Redirecionar para a página de criação de eventos');
});
