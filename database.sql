SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET @@time_zone = '+03:00';

INSERT INTO `modulos` (`nome`, `url`, `icone`, `status`, `ordem`, `tabela`, `cod_head`, `data_atualizacao`, `chave`, `acao`)
SELECT "Ecommerce", "ecommerce.php", "icon-shopping-bag", 1, 0, "ecommerce", "ecommerce/ecommerce.js", "2019-05-07", "72b4b1d7ce2b514a981a49b1db5790a7", "{\"pedidos\":[\"notificar\",\"editar\",\"deletar\"],\"listagem\":[\"adicionar\",\"editar\",\"deletar\"],\"categoria\":[\"adicionar\",\"editar\",\"deletar\"],\"marca\":[\"adicionar\",\"editar\",\"deletar\"],\"atributo\":[\"adicionar\",\"editar\",\"deletar\"],\"termo\":[\"adicionar\",\"editar\",\"deletar\"],\"produto\":[\"adicionar\",\"editar\",\"deletar\"],\"codigo\":[\"acessar\"],\"configuracao\":[\"acessar\"]}";

-- CONFIGURAÇÃO DO ECOMMERCE
CREATE TABLE IF NOT EXISTS `ecommerce_config` (
  `id` varchar(255) NOT NULL,
  `valor` varchar(255) DEFAULT NULL,
  UNIQUE (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `ecommerce_config` (`id`, `valor`) VALUES
('pagina_carrinho', ''),
('pagina_resultado_busca', ''),
('pagina_checkout', ''),
('matriz_produto', ''),
('listagem_cor_titulo', ''),
('listagem_cor_preco', ''),
('listagem_cor_borda', ''),
('listagem_cor_botao', ''),
('listagem_cor_hover_botao', ''),
('listagem_cor_filtro', ''),
('listagem_estilo', ''),
('busca_btn_tipo', 'ambos'),
('busca_btn_cor', ''),
('busca_btn_cor_hover', ''),
('busca_btn_tamanho', 'normal'),
('btn_carrinho_cor_btn_meu_carrinho', ''),
('btn_carrinho_cor_fundo', ''),
('btn_carrinho_cor_texto', ''),
('btn_carrinho_cor_btn_ver_carrinho', ''),
('btn_carrinho_cor_hover_btn_ver_carrinho', ''),
('btn_carrinho_cor_texto_btn_ver_carrinho', ''),
('produto_cor_titulo', ''),
('produto_cor_texto_botao', ''),
('produto_cor_preco', ''),
('produto_cor_botao', ''),
('produto_cor_hover_botao', ''),
('produto_cor_texto_descricao', ''),
('produto_cor_tag_categoria', ''),
('produto_cor_texto_tag_categoria', ''),
('busca_limite_pagina', '10'),
('busca_btn_cor_texto', ''),
('carrocel_cor_btn', ''),
('carrocel_cor_hover_btn', ''),
('carrocel_cor_btn_texto', ''),
('carrocel_cor_titulo', ''),
('carrocel_cor_hover_titulo', ''),
('carrocel_cor_descricao', ''),
('carrocel_cor_setas', ''),
('carrocel_cor_hover_setas', ''),
('carrinho_cor_btns', ''),
('carrinho_cor_btn_finalizar', ''),
('moeda', 'R&#x00024;');


-- CATEGORIA
CREATE TABLE IF NOT EXISTS `ecommerce_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ATRIBUTOS
CREATE TABLE IF NOT EXISTS `ecommerce_atributos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- MARCAS
CREATE TABLE IF NOT EXISTS `ecommerce_marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `descricao` text CHARACTER SET utf8 DEFAULT NULL,
  `imagem` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TERMOS
CREATE TABLE IF NOT EXISTS `ecommerce_termos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_atributo` int(11) DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO
CREATE TABLE IF NOT EXISTS `ecommerce` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `resumo` text DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `codigo` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `palavras_chave` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `etiqueta` varchar(255) DEFAULT NULL,
  `etiqueta_cor` varchar(255) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `id_imagem_capa` int(11) DEFAULT NULL,
  `btn_texto` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT 0,
  `view` int(11) DEFAULT 0,
  `ordem_manual` int(11) DEFAULT NULL,
  `count_add_cart` int(11) DEFAULT 0,
  `diminuir_est` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `comprimento` varchar(255) DEFAULT NULL,
  `altura` varchar(255) DEFAULT NULL,
  `largura` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- PRODUTO - CATEGORIAS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- PRODUTO - TERMOS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_termos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) DEFAULT NULL,
  `id_atributo` int(11) DEFAULT NULL,
  `id_termo` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO - MARCAS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_marcas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO - ATRIBUTOS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_atributos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) DEFAULT NULL,
  `id_atributos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- PRODUTO - IMAGENS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) NOT NULL,
  `uniq` varchar (255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- PRODUTO - PRODUTOS RELACIONADOS
CREATE TABLE IF NOT EXISTS `ecommerce_prod_relacionados` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_produto` int(11) NOT NULL,
  `id_produto_relacionado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- LISTAGEM
CREATE TABLE IF NOT EXISTS `ecommerce_listas` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `ordenar_por` varchar(255) NOT NULL,
  `asc_desc` enum('ASC','DESC') NOT NULL DEFAULT 'ASC',
  `colunas` int(11) NOT NULL,
  `mostrar_paginacao` enum('S', 'N') DEFAULT 'N',
  `mostrar_filtro` enum('S', 'N') DEFAULT 'S',
  `paginacao` int(11),
  `efeito` varchar(100) DEFAULT NULL,
  `tipo` enum('1','2','3','4','5') DEFAULT '1',
  `carrocel` enum('S', 'N') DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- LISTAGEM - CATEGORIAS
CREATE TABLE IF NOT EXISTS `ecommerce_lista_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_lista` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- LISTAGEM - MARCAS
CREATE TABLE IF NOT EXISTS `ecommerce_lista_marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_lista` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- VENDAS
CREATE TABLE IF NOT EXISTS `ecommerce_vendas` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `tipo_pessoa` varchar(255) NOT NULL,
  `id_pessoa` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `rua` text NOT NULL,
  `numero` varchar(255) NOT NULL,
  `complemento` text NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nota` text DEFAULT NULL,
  `tipo_entrega` varchar(255) NOT NULL,
  `tipo_pagamento` varchar(255) NOT NULL,
  `valor` float(50,2) NOT NULL,
  `produto` text NOT NULL,
  `data` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `rastreamento` text DEFAULT NULL,
  `cor_status` varchar(255) DEFAULT NULL,
  `vl_frete` float(50,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- CONFIGURAR E-MAIL DE NOTIFICAÇÃO

CREATE TABLE IF NOT EXISTS `ecommerce_config_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `remetente` varchar(255) NOT NULL,
  `t_pagamento_pendente` varchar(255) DEFAULT NULL,
  `pagamento_pendente` text,
  `t_processando` varchar(255) DEFAULT NULL,
  `processando` text,
  `t_aguardando` varchar(255) DEFAULT NULL,
  `aguardando` text,
  `t_pedido_enviado` varchar(255) DEFAULT NULL,
  `pedido_enviado` text NOT NULL,
  `t_concluido` varchar(255) NOT NULL,
  `concluido` text NOT NULL,
  `t_cancelado` varchar(255) NOT NULL,
  `cancelado` text NOT NULL,
  `t_reembolsado` varchar(255) NOT NULL,
  `email_usuario` varchar(255) DEFAULT NULL,
  `email_senha` varchar(255) DEFAULT NULL,
  `email_porta` varchar(255) DEFAULT NULL,
  `email_servidor` varchar(255) DEFAULT NULL,
  `email_protocolo_seguranca` varchar(255) DEFAULT NULL,
  `reembolsado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CONFIGURAR ENTREGA DE PRODUTO

CREATE TABLE IF NOT EXISTS `ecommerce_config_entrega` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `complemento` text DEFAULT NULL,
  `entrega` VARCHAR(255) DEFAULT NULL, 
  `retirada` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CONFIGURAR PAGSEGURO

CREATE TABLE  IF NOT EXISTS `ecommerce_config_pagseguro` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CONFIGURAR DEPOSITO EM CONTA

CREATE TABLE IF NOT EXISTS `ecommerce_config_deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `instucoes` varchar(255) DEFAULT NULL,
  `detalhes` text,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CONFIGURAR LINK DE ACOMPANHAMENTO

CREATE TABLE IF NOT EXISTS `ecommerce_config_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `logo` varchar(255) DEFAULT NULL,
  `cabecalho` varchar(255) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- PLUG-INS
CREATE TABLE IF NOT EXISTS `ecommerce_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titulo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo` VARCHAR(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ecommerce_config_deposito` (`id`, `titulo`, `descricao`, `instucoes`, `detalhes`, `status`) VALUES
(1, '', '', '', '', '');

INSERT INTO `ecommerce_config_pagseguro` (`id`, `email`, `token`, `status`) VALUES
(1, '', '', '');

INSERT INTO `ecommerce_config_entrega` (`id`, `estado`, `cidade`, `bairro`, `rua`, `numero`, `cep`, `telefone`, `email`, `complemento`, `entrega`, `retirada`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `ecommerce_config_email` (`id`, `nome`, `remetente`, `t_pagamento_pendente`, `pagamento_pendente`, `t_processando`, `processando`, `t_aguardando`, `aguardando`, `t_pedido_enviado`, `pedido_enviado`, `t_concluido`, `concluido`, `t_cancelado`, `cancelado`, `t_reembolsado`, `reembolsado`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

INSERT INTO `ecommerce_config_link` (`id`, `logo`, `cabecalho`, `texto`) VALUES
(1, '', '', '');

SELECT * FROM `ecommerce_vendas` ORDER BY 'data' DESC;

