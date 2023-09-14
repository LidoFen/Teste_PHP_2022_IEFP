# Teste_PHP_2022_IEFP
 
Notas Gerais:
Esta prova de natureza teórico-prática contém um grupo de componente prática.
Deverá entregar um ficheiro em formato ZIP com o nome ufcd5417_nomedoformando e dentro
deste terão de estar em formato ZIP os ficheiros do projecto e um em formato SQL.
Qualquer tentativa de plágio será punida com a anulação da prova.

Grupo I
A Empresa Alentejo Winery pretende um sistema para gerir a campanha das vindimas, para
esse efeito foi disponibilizada a base de dados wineryAlentejo e o sistema pedido tem os
seguintes requisitos:
1. Registar Vinhas
2. Remover Vinhas
3. Editar Vinhas
4. Lista de Vinhas
5. Registar Funcionário
6. Alterar Estado do Funcionário
7. Registar Vindima
8. Remover Vindima
9. Adicionar Vinhos
10. Listar Vindima
11. Adicionar Ano
12. Stock
NOTAS:
- Todos os pontos poderão ter um aspecto gráfico à sua escolha.
- A base de dados deve ter o nome de “wineryAlentejo”
- Deve ter 3 páginas web com Vinhas, Funcionários, Vindimas (stock é colocado nesta
página)
- Todos os campos de ligação devem ser efetuados com select box
- No ponto 1 da lista de requisitos deve ter em consideração:
- A vinha pode ter várias castas que são atribuídas após o registo da vinha
- O campo ano_p_colheita na base de dados é o ano para a primeira colheita
- No ponto 2 só poderão ser removidas vinhas que não tenham qualquer registo de vindima,
alerte o utilizador com uma mensagem correta.
- No ponto 3 deverá primeiro mostrar todos os valores antes de os editar
- No ponto 4 deverá listar as vinhas com todo o conteúdo presente na tabela, sendo a
imagem a primeira coluna da tabela.
- No ponto 6 deve escolher um funcionário e clicar num botão para alterar o estado de
inactivo para activo, por esse motivo só aparecem na lista funcionários inactivos.
- No ponto 7 da lista de requisitos deve ter em consideração:
- só podem dar entrada de vindimas funcionários que estejam no estado ativo
- Só podem ser adicionadas vindimas a vinhas em que o ano da primeira colheita seja
superior ou igual ao ano atribuído à vindima
- quando é registada a vindima é quando pode ser adicionado um novo ano, caso não
esteja presente para ser escolhido na select box
- No ponto 8 só podem ser removidas vindimas registadas por funcionários no estado
inactivo.
- No ponto 9 não existe formulário, a adição é automática pelo sistema sabendo:
- que cada 2kg de uva dá origem a 1 garrafa de vinho
- As castas do vinho são as presentes na vinha
- O Nome do vinho é constituído pelo ano da vindima e pelo nome da vinha, ex: “Vinha
Nova 2022”
- Deve ser registado no momento do registo da vindima.
- No ponto 10 a listagem tem a foto da vinha no primeiro campo
- No ponto 12 ao consultar o stock deve listar todos os vinhos, com a seguinte informação na
tabela:
- Nome do Vinho
- Quantidade total
- Castas
- Botão de Venda (Neste botão ao clicar deverá abater garrafas ao stock de vinhos.)
- Deve ser possível filtrar o stock por ano
