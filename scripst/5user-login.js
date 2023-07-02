// Importar classes necessárias
import User from './User.php';
import Authentication from './Authentication.php';

// Selecionar elementos do formulário
const loginForm = document.getElementById('login-form');
const emailInput = document.getElementById('email-input');
const passwordInput = document.getElementById('password-input');

// Adicionar evento de envio ao formulário de login
loginForm.addEventListener('submit', function(event) {
  event.preventDefault();
  
  // Obter dados do formulário
  const email = emailInput.value;
  const password = passwordInput.value;

  // Criar instância da classe User com os dados do formulário
  const user = new User(email, password);

  // Realizar processo de autenticação
  const authentication = new Authentication();
  const isAuthenticated = authentication.login(user);

  if (isAuthenticated) {
    // Login bem-sucedido, redirecionar para página principal
    window.location.href = 'home.php';
  } else {
    // Login falhou, exibir mensagem de erro
    const errorContainer = document.getElementById('error-container');
    errorContainer.textContent = 'Credenciais inválidas. Por favor, verifique seu e-mail e senha.';
  }
});
