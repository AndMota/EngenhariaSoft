/*GRANT ALL PRIVILEGES ON lojaze.usuarios TO 'seuze'@'localhost';*/

/* ENTREGA 3 */
SELECT nome, cpf, email, telefone, endereco, complemento, cidade, estado, cep, tipo
FROM usuarios 
ORDER BY usuarios.nome ASC

/* ENTREGA 4 */

select nome, tipo from usuarios where email = 'thiago9864@hotmail.com' and senha = '1234';