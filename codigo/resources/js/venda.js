const addProdutoArea = document.getElementById("produto-area");
const addProdutoBtn = document.getElementById("add-produto-btn");
const labelProdutoQuantidade = document.getElementById("container-produto");
//const btnSubmit = document.getElementById("btn-submit");
//const limparVenda = document.getElementById("limpar-venda");

addProdutoBtn.addEventListener("click", () => {
    const newProdutoArea = addProdutoArea.cloneNode(true);
    newProdutoArea.querySelectorAll("input").forEach(field => field.value = "0");
    newProdutoArea.querySelectorAll("select").forEach(field => field.value = "");
    labelProdutoQuantidade.appendChild(newProdutoArea);
    //setValorTotal();
});

function removeRow(row) {
    const grupoInputs = document.querySelectorAll(".produto-area");
    if(grupoInputs.length > 1) {
        row.parentNode.remove(row.parentNode);
        //setValorTotal();
    }
}

/* limparVenda.addEventListener("click", () => {
    labelProdutoQuantidade.innerHTML = "";
    addProdutoArea.querySelectorAll("input").forEach(field => field.value = "0");
    addProdutoArea.querySelectorAll("select").forEach(field => field.value = "");
    labelProdutoQuantidade.appendChild(addProdutoArea);
    setValorTotal();
})



function setValorTotal() {
    const inputQuantidade = document.querySelectorAll(".quantidade");
    const inputValorUnit = document.querySelectorAll(".valor-unit");
    const inputValorTotal = document.getElementById("valor-total");

    const valorT = 0;

    for (let i = 0; i < inputQuantidade.length; i++) {
        valorT += parseFloat(inputValorUnit[i].value) * parseFloat(inputQuantidade[i].value);
    }

    inputValorTotal.value = `R$ ${valorT.toFixed(2)}`;
    
} */