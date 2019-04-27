/*GRANT ALL PRIVILEGES ON lojaze.usuarios TO 'seuze'@'localhost';*/

/* ENTREGA 3 */
SELECT nome, cpf, email, telefone, endereco, complemento, cidade, estado, cep, tipo
FROM usuarios 
ORDER BY usuarios.nome ASC