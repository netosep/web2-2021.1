------------------------------------------------------------------------------
-- funções para compra

-- função para atualizar o valor total da compra e a quantidade do produto
/* CREATE OR REPLACE FUNCTION SetCompra()
RETURNS TRIGGER AS $$

	-- lucro hipotetico de 40% encima de cada produto
	DECLARE var_acrescimo_despesas numeric(7,2) := (0.4);

	BEGIN
		
		UPDATE compra 
		SET valor_total = valor_total + (NEW.quantidade * (NEW.preco_compra + (NEW.preco_compra * (NEW.icms + NEW.ipi + NEW.frete))))
		WHERE id_compra = NEW.id_compra;

		UPDATE produto
		SET icms = NEW.icms,
				ipi = NEW.ipi,
				frete = NEW.frete,
				acrescimo_despesas = var_acrescimo_despesas,
				preco_compra = NEW.preco_compra + (NEW.preco_compra * (NEW.icms + NEW.ipi + NEW.frete)),
				preco_na_fabrica = NEW.preco_compra,
				preco_venda = NEW.preco_compra + (NEW.preco_compra * (NEW.icms + NEW.ipi + NEW.frete + var_acrescimo_despesas)),
				quantidade = quantidade + NEW.quantidade
		WHERE id_produto = NEW.id_produto;
	
		RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER SetCompra
AFTER INSERT ON item_compra
FOR EACH ROW
EXECUTE PROCEDURE SetCompra(); */


-- função para atualizar o valor total da compra e a quantidade do produto
/* CREATE OR REPLACE FUNCTION AttCompra()
RETURNS TRIGGER AS $$

	-- lucro hipotetico de 40% encima de cada produto
	DECLARE var_acrescimo_despesas numeric(7,2) := (0.4);
	DECLARE quant_estoque int4 := (SELECT pr.quantidade FROM produto AS pr WHERE pr.id_produto = NEW.id_produto);

	BEGIN
	
		UPDATE compra 
		SET valor_total = valor_total - (
			(OLD.quantidade * (OLD.preco_compra + (OLD.preco_compra * (OLD.icms + OLD.ipi + OLD.frete)))) -
			(NEW.quantidade * (NEW.preco_compra + (NEW.preco_compra * (NEW.icms + NEW.ipi + NEW.frete))))
		)
		WHERE id_compra = NEW.id_compra;

		UPDATE produto
		SET icms = icms - (OLD.icms - NEW.icms),
				ipi = ipi - (OLD.ipi - NEW.ipi),
				frete = frete - (OLD.frete - NEW.frete),
				preco_compra = preco_compra - (
					(OLD.preco_compra + (OLD.preco_compra * (OLD.icms + OLD.ipi + OLD.frete))) -
					(NEW.preco_compra + (NEW.preco_compra * (NEW.icms + NEW.ipi + NEW.frete)))
				),
				preco_na_fabrica = preco_na_fabrica - (OLD.preco_compra - NEW.preco_compra),
				preco_venda = preco_venda - (
					(OLD.preco_compra + (OLD.preco_compra * (OLD.icms + OLD.ipi + OLD.frete + var_acrescimo_despesas))) -
					(NEW.preco_compra + (NEW.preco_compra * (NEW.icms + NEW.ipi + NEW.frete + var_acrescimo_despesas)))
				),
				quantidade = quantidade - (OLD.quantidade - NEW.quantidade)
		WHERE id_produto = NEW.id_produto;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER AttCompra
AFTER UPDATE ON item_compra
FOR EACH ROW
EXECUTE PROCEDURE AttCompra(); */


-- função para atualizar o valor total da compra e a quantidade do produto
/* CREATE OR REPLACE FUNCTION DelCompra()
RETURNS TRIGGER AS $$
	BEGIN
	
		UPDATE compra 
		SET valor_total = valor_total - (
			OLD.quantidade * (OLD.preco_compra + (OLD.preco_compra * (OLD.icms + OLD.ipi + OLD.frete)))
		)
		WHERE id_compra = OLD.id_compra;
		
		UPDATE produto SET quantidade = quantidade - OLD.quantidade WHERE id_produto = OLD.id_produto;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER DelCompra
AFTER DELETE ON item_compra
FOR EACH ROW
EXECUTE PROCEDURE DelCompra(); */


------------------------------------------------------------------------------
---- funções para venda

/* CREATE OR REPLACE FUNCTION SetVenda()
RETURNS TRIGGER AS $$

	DECLARE quantidade_estoque int4 := (SELECT quantidade FROM produto WHERE id_produto = NEW.id_produto);
	DECLARE var_preco_compra decimal(7,2) := (SELECT preco_compra FROM produto WHERE id_produto = NEW.id_produto);

	BEGIN
		
		IF NEW.quantidade > quantidade_estoque THEN
			RAISE EXCEPTION 'A quantidade a ser vendida (%) é maior que a quantidade em estoque (%)', NEW.quantidade, quantidade_estoque;
		ELSE
			UPDATE venda SET valor_total = valor_total + (NEW.quantidade * NEW.valor_unitario) WHERE id_venda = NEW.id_venda;
			UPDATE produto 
			SET quantidade = quantidade - NEW.quantidade,
					lucro = lucro + ((NEW.valor_unitario - var_preco_compra) * NEW.quantidade)
			WHERE id_produto = NEW.id_produto;
		END IF;
		
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER SetVenda
AFTER INSERT ON item_venda
FOR EACH ROW
EXECUTE PROCEDURE SetVenda(); */


/* CREATE OR REPLACE FUNCTION AttVenda()
RETURNS TRIGGER AS $$
	
	DECLARE quantidade_estoque int4 := (SELECT quantidade FROM produto WHERE id_produto = NEW.id_produto);
	DECLARE var_preco_compra decimal(7,2) := (SELECT preco_compra FROM produto WHERE id_produto = NEW.id_produto);

	BEGIN
	
		IF (quantidade_estoque + (OLD.quantidade - NEW.quantidade)) < 0 THEN
			RAISE EXCEPTION 'A quantidade a ser vendida (%) é maior que a quantidade em estoque (%)', NEW.quantidade, quantidade_estoque;
		ELSE
			UPDATE venda SET valor_total = valor_total - ((OLD.quantidade * OLD.valor_unitario) - (NEW.quantidade * NEW.valor_unitario)) WHERE id_venda = OLD.id_venda;
			UPDATE produto
			SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade),
					lucro = lucro - (
						((OLD.valor_unitario - var_preco_compra) * OLD.quantidade) -
						((NEW.valor_unitario - var_preco_compra) * NEW.quantidade)
					)
			WHERE id_produto = NEW.id_produto;
		END IF;
		
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER AttVenda
AFTER UPDATE ON item_venda
FOR EACH ROW
EXECUTE PROCEDURE AttVenda(); */


/* CREATE OR REPLACE FUNCTION DelVenda()
RETURNS TRIGGER AS $$

	DECLARE var_preco_compra decimal(7,2) := (SELECT preco_compra FROM produto WHERE id_produto = OLD.id_produto);
	
	BEGIN
	
		UPDATE venda SET valor_total = valor_total - (OLD.quantidade * OLD.valor_unitario) WHERE id_venda = OLD.id_venda;
		UPDATE produto
		SET quantidade = quantidade + OLD.quantidade,
				lucro = lucro - ((OLD.valor_unitario - var_preco_compra) * OLD.quantidade)
		WHERE id_produto = OLD.id_produto;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER DelVenda
AFTER DELETE ON item_venda
FOR EACH ROW
EXECUTE PROCEDURE DelVenda(); */


------------------------------------------------------------------------------
-- funções para o caixa

-- função para atualizar o valor de caixa ao realizar uma venda
/* CREATE OR REPLACE FUNCTION SetValorEmCaixa()
RETURNS TRIGGER AS $$
	BEGIN
	
		UPDATE caixa SET valor_em_caixa = valor_em_caixa + NEW.valor_total WHERE id_caixa = NEW.id_caixa;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER SetValorEmCaixa
AFTER INSERT ON venda
FOR EACH ROW
EXECUTE PROCEDURE SetValorEmCaixa(); */


-- função para atualizar o valor de caixa ao realizar uma venda
/* CREATE OR REPLACE FUNCTION AttValorEmCaixa()
RETURNS TRIGGER AS $$
	BEGIN
	
		UPDATE caixa SET valor_em_caixa = valor_em_caixa - (OLD.valor_total - NEW.valor_total) WHERE id_caixa = NEW.id_caixa;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER AttValorEmCaixa
AFTER UPDATE ON venda
FOR EACH ROW
EXECUTE PROCEDURE AttValorEmCaixa(); */


-- função para atualizar o valor de caixa ao realizar uma venda
/* CREATE OR REPLACE FUNCTION DelValorEmCaixa()
RETURNS TRIGGER AS $$
	BEGIN
	
		UPDATE caixa SET valor_em_caixa = valor_em_caixa - OLD.valor_total WHERE id_caixa = OLD.id_caixa;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER DelValorEmCaixa
AFTER DELETE ON venda
FOR EACH ROW
EXECUTE PROCEDURE DelValorEmCaixa(); */

------------------------------------------------------------------------------
---- funções para devolução

-- função para atualizar o valor de credito de um cliente e a quantidade do produto de uma venda ao realizar uma devolução
/* CREATE OR REPLACE FUNCTION SetDevolucao()
RETURNS TRIGGER AS $$

	DECLARE quantidade_vendida int4 := (SELECT quantidade FROM item_venda WHERE id_item_venda = NEW.id_item_venda);
	
	BEGIN
	
		IF NEW.quantidade > quantidade_vendida THEN
			RAISE EXCEPTION 'A quantidade a ser devolvida (%) é maior que a quantidade vendida (%)', NEW.quantidade, quantidade_vendida;
		ELSE
			
			UPDATE cliente SET credito = credito + (NEW.quantidade * (SELECT valor_unitario FROM item_venda WHERE id_item_venda = NEW.id_item_venda))
			WHERE id_cliente = (
				SELECT C.id_cliente FROM cliente AS C, venda AS V, item_venda AS IV
					WHERE C.id_cliente = V.id_cliente
					AND V.id_venda = IV.id_venda
					AND IV.id_item_venda = NEW.id_item_venda
			);
			
			UPDATE item_venda SET quantidade = quantidade - NEW.quantidade WHERE id_item_venda = NEW.id_item_venda;
			
		END IF;

	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER SetDevolucao
AFTER INSERT ON devolucao
FOR EACH ROW
EXECUTE PROCEDURE SetDevolucao(); */


-- função para atualizar o valor de credito de um cliente e a quantidade do produto de uma venda ao realizar uma devolução
/* CREATE OR REPLACE FUNCTION AttDevolucao()
RETURNS TRIGGER AS $$

	DECLARE quantidade_vendida int4 := (SELECT quantidade FROM item_venda WHERE id_item_venda = NEW.id_item_venda);

	BEGIN
	
		IF (quantidade_vendida + (OLD.quantidade - NEW.quantidade)) < 0 THEN
			RAISE EXCEPTION 'A quantidade a ser devolvida (%) é maior que a quantidade vendida (%)', NEW.quantidade, quantidade_vendida;
		ELSE
		
			UPDATE cliente SET credito = credito + (
				(NEW.quantidade * (SELECT valor_unitario FROM item_venda WHERE id_item_venda = NEW.id_item_venda)) - 
				(OLD.quantidade * (SELECT valor_unitario FROM item_venda WHERE id_item_venda = NEW.id_item_venda))
			)
			WHERE id_cliente = (
				SELECT C.id_cliente FROM cliente AS C, venda AS V, item_venda AS IV
					WHERE C.id_cliente = V.id_cliente
					AND V.id_venda = IV.id_venda
					AND IV.id_item_venda = NEW.id_item_venda
			);
			
			UPDATE item_venda SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade) WHERE id_item_venda = NEW.id_item_venda;
			
		END IF;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER AttDevolucao
AFTER UPDATE ON devolucao
FOR EACH ROW
EXECUTE PROCEDURE AttDevolucao(); */


-- função para atualizar o valor de credito de um cliente e a quantidade do produto de uma venda ao realizar uma devolução
/* CREATE OR REPLACE FUNCTION DelDevolucao()
RETURNS TRIGGER AS $$
	BEGIN
	
		UPDATE cliente SET credito = credito - (OLD.quantidade * (SELECT valor_unitario FROM item_venda WHERE id_item_venda = OLD.id_item_venda))
		WHERE id_cliente = (
				SELECT C.id_cliente FROM cliente AS C, venda AS V, item_venda AS IV
					WHERE C.id_cliente = V.id_cliente
					AND V.id_venda = IV.id_venda
					AND IV.id_item_venda = OLD.id_item_venda
		);
				
		UPDATE item_venda SET quantidade = quantidade + OLD.quantidade WHERE id_item_venda = OLD.id_item_venda;
	
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER DelDevolucao
AFTER DELETE ON devolucao
FOR EACH ROW
EXECUTE PROCEDURE DelDevolucao(); */


------------------------------------------------------------------------------
-- função para definir o valor e o numero de parcelas
/* CREATE OR REPLACE FUNCTION SetParcelas()
RETURNS TRIGGER AS $$

	DECLARE parcela int4 := 1;
	DECLARE data_parcela int4 := 30;
	
	BEGIN
	
		WHILE parcela <= NEW.numero_de_parcelas LOOP
		
			INSERT INTO parcelas (id_pagamento_venda, numero_da_parcela, valor_parcela, data_vencimento, status)
			VALUES (NEW.id_pagamento_venda, parcela, (NEW.valor_a_pagar / NEW.numero_de_parcelas), (CURRENT_DATE + data_parcela), 'NP');
			
			data_parcela := data_parcela + 30;
			parcela := parcela + 1;
			
		END LOOP;

	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER SetParcelas
AFTER INSERT ON pagamento_venda
FOR EACH ROW
EXECUTE PROCEDURE SetParcelas(); */


-- função para definir o valor e o numero de parcelas
/* CREATE OR REPLACE FUNCTION AttParcelas()
RETURNS TRIGGER AS $$

	DECLARE parcela int4 := 1;
	DECLARE data_parcela int4 := 30;
	
	BEGIN
	
		DELETE FROM parcelas WHERE id_pagamento_venda = OLD.id_pagamento_venda;
	
		WHILE parcela <= NEW.numero_de_parcelas LOOP
		
			INSERT INTO parcelas (id_pagamento_venda, numero_da_parcela, valor_parcela, data_vencimento, status)
			VALUES (NEW.id_pagamento_venda, parcela, (NEW.valor_a_pagar / NEW.numero_de_parcelas), (CURRENT_DATE + data_parcela), 'NP');
			
			data_parcela := data_parcela + 30;
			parcela := parcela + 1;
			
		END LOOP;

	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER AttParcelas
AFTER UPDATE ON pagamento_venda
FOR EACH ROW
EXECUTE PROCEDURE AttParcelas(); */

-- função para deletar as parcelas
-- ver sobre possivel erro nessa função
/* CREATE OR REPLACE FUNCTION DelParcelas()
RETURNS TRIGGER AS $$
	
	BEGIN
	
		DELETE FROM parcelas WHERE id_pagamento_venda = OLD.id_pagamento_venda;

	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER DelParcelas
AFTER DELETE ON pagamento_venda
FOR EACH ROW
EXECUTE PROCEDURE DelParcelas(); */

------------------------------------------------------------------------------
-- função para definir o valor devido pelo cliente
/* CREATE OR REPLACE FUNCTION SetDebito()
RETURNS TRIGGER AS $$

	DECLARE var_debito decimal(7,2);
	
	BEGIN
		
		-- verificação se o tipo da trigger
		-- é do tipo DELETE
		IF (TG_OP = 'DELETE') THEN
			var_debito := (
				SELECT sum(valor_parcela) FROM parcelas
				WHERE status = 'NP'
				AND id_pagamento_venda = OLD.id_pagamento_venda
			);
			
			UPDATE cliente SET debito = var_debito
			WHERE id_cliente = (
				SELECT id_cliente FROM venda AS v, pagamento_venda AS pv
				WHERE v.id_venda = pv.id_venda
				AND pv.id_pagamento_venda = OLD.id_pagamento_venda
			);
		ELSE
			var_debito := (
				SELECT sum(valor_parcela) FROM parcelas
				WHERE status = 'NP'
				AND id_pagamento_venda = NEW.id_pagamento_venda
			);
			
			UPDATE cliente SET debito = var_debito
			WHERE id_cliente = (
				SELECT id_cliente FROM venda AS v, pagamento_venda AS pv
				WHERE v.id_venda = pv.id_venda
				AND pv.id_pagamento_venda = NEW.id_pagamento_venda
			);
		END IF;
		
	RETURN NULL;
	END $$
LANGUAGE plpgsql;

CREATE TRIGGER SetDebito
AFTER INSERT OR UPDATE OR DELETE ON parcelas
FOR EACH ROW
EXECUTE PROCEDURE SetDebito(); */