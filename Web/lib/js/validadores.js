function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');

    if (cpf == '' || cpf.length != 11) {
        return false;
    }

    // Valida o primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }

    let resto = 11 - (soma % 11);
    let dv1 = resto == 10 || resto == 11 ? 0 : resto;

    if (dv1 != parseInt(cpf.charAt(9))) {
        return false;
    }

    // Valida o segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }

    resto = 11 - (soma % 11);
    let dv2 = resto == 10 || resto == 11 ? 0 : resto;

    if (dv2 != parseInt(cpf.charAt(10))) {
        return false;
    }

    return true;
}

function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
  
    if (cnpj == '' || cnpj.length != 14) {
      return false;
    }
  
    // Valida o primeiro dígito verificador
    let soma = 0;
    let peso = 5;
    for (let i = 0; i < 12; i++) {
      soma += parseInt(cnpj.charAt(i)) * peso;
      peso = peso == 2 ? 9 : peso - 1;
    }
  
    let resto = soma % 11;
    let dv1 = resto < 2 ? 0 : 11 - resto;
  
    if (dv1 != parseInt(cnpj.charAt(12))) {
      return false;
    }
  
    // Valida o segundo dígito verificador
    soma = 0;
    peso = 6;
    for (let i = 0; i < 13; i++) {
      soma += parseInt(cnpj.charAt(i)) * peso;
      peso = peso == 2 ? 9 : peso - 1;
    }
  
    resto = soma % 11;
    let dv2 = resto < 2 ? 0 : 11 - resto;
  
    if (dv2 != parseInt(cnpj.charAt(13))) {
      return false;
    }
  
    return true;
  }

