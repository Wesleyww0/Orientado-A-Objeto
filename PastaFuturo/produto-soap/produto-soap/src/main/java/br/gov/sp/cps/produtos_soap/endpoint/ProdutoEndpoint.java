package br.gov.sp.cps.produtos_soap.endpoint;

import org.springframework.ws.server.endpoint.annotation.Endpoint;
import org.springframework.ws.server.endpoint.annotation.PayloadRoot;
import org.springframework.ws.server.endpoint.annotation.RequestPayload;
import org.springframework.ws.server.endpoint.annotation.ResponsePayload;

import br.gov.sp.cps.produtos_soap.model.ConsultarProdutoRequest;
import br.gov.sp.cps.produtos_soap.model.ConsultarProdutoResponse;

@Endpoint
public class ProdutoEndpoint {

    private static final String NAMESPACE_URI = "http://cps.sp.gov.br/produtos";

    @PayloadRoot(namespace = NAMESPACE_URI, localPart = "consultarProdutoRequest")
    @ResponsePayload
    public ConsultarProdutoResponse consultarProduto(@RequestPayload ConsultarProdutoRequest request) {
        
        ConsultarProdutoResponse response = new ConsultarProdutoResponse();

        if ("Caixa Chocolate".equalsIgnoreCase(request.getNome())) {
            response.setNome("Caixa Chocolate");
            response.setDescricao("Caixa com chocolates diversos");
            response.setMarca("Nestle");
            response.setQuantidadeEstoque(2);
        } else {
            response.setNome("Produto não encontrado");
            response.setDescricao("-");
            response.setMarca("-");
            response.setQuantidadeEstoque(0);
        }

        return response;
    }
}