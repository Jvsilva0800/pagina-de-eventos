-- Tabela 'users' para armazenar informações sobre os usuários
CREATE TABLE users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_type ENUM('organizer', 'participant', 'administrator') NOT NULL
);


-- Tabela 'events' para armazenar informações sobre os eventos
CREATE TABLE events (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  location VARCHAR(255) NOT NULL,
  category_id INT(11) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  image VARCHAR(255),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);


-- Tabela 'registrations' para armazenar informações sobre as inscrições nos eventos
CREATE TABLE registrations (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  event_id INT(11) NOT NULL,
  payment_status ENUM('pending', 'paid') NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (event_id) REFERENCES events(id)
);


-- Tabela 'reviews' para armazenar informações sobre as avaliações e comentários dos eventos
CREATE TABLE reviews (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user_id INT(11) NOT NULL,
  event_id INT(11) NOT NULL,
  rating INT(11) NOT NULL,
  comment TEXT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (event_id) REFERENCES events(id)
);


-- Tabela 'categories' para armazenar informações sobre as categorias de eventos
CREATE TABLE categories (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

