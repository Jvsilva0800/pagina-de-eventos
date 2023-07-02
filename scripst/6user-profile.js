// Importar classes necessárias
import User from './User';

// Selecionar elemento
const profileDetails = document.getElementById('profile-details');

// Simulação de dados do perfil do usuário
const userProfileData = {
  name: 'Nome do Usuário',
  email: 'email@example.com',
  // Outras informações do perfil do usuário
};

// Criar instância do usuário
const user = new User(userProfileData.name, userProfileData.email);

// Atualizar os detalhes do perfil do usuário na página
profileDetails.innerHTML = `
  <h2>${user.getName()}</h2>
  <p>Email: ${user.getEmail()}</p>
  <!-- Outras informações do perfil -->
`;
