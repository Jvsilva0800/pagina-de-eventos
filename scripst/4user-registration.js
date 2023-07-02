import User from './User';
import Registration from './Registration';

// Selecionar elementos
const registrationForm = document.getElementById('registration-form');
const nameInput = document.getElementById('name-input');
const emailInput = document.getElementById('email-input');
const passwordInput = document.getElementById('password-input');
const registerButton = document.getElementById('register-button');

// Adicionar evento de registro ao formulário
registrationForm.addEventListener('submit', function(event) {
  event.preventDefault();
  const name = nameInput.value;
  const email = emailInput.value;
  const password = passwordInput.value;
  // Realizar ação de registro com os dados inseridos
  registerUser(name, email, password);
});

// Função para registrar usuário
function registerUser(name, email, password) {
  // Criar instância do usuário
  const user = new User(name, email, password);

  // Criar instância do registro
  const registration = new Registration(user);

  // Realizar o registro
  registration.register()
    .then(userData => {
      // Ação após o registro do usuário
      console.log('Usuário registrado com sucesso:', userData);
    })
    .catch(error => {
      console.error('Erro ao registrar usuário:', error);
    });
}
