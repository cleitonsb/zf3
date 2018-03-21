 $(document).ready(function () {
	 
	 /**
	 * Mascaras
	 */
	$('.data').mask('00/00/0000', {clearIfNotMatch: true});
	$('.expiracao').mask('00/00', {clearIfNotMatch: true});
	$('.cep').mask('00000-000', {clearIfNotMatch: true});
	$('.cpf').mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});
	$('.cnpj').mask('00.000.000/0000-00', {reverse: true, clearIfNotMatch: true});
	$('.moeda').mask('000.000.000.000.000,00', {reverse: true});
	$('.porcento').mask('##0,00%', {reverse: true});
	$('.inteiro').mask('0000000000000000');
	$('.cvv3').mask('000');
	$('.cvv4').mask('0000');
	
	$('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
	
	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};

	$('.fone').mask(SPMaskBehavior, spOptions, {clearIfNotMatch: true});
	
	var CCMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-00999';
	}, ccOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(CCMaskBehavior.apply({}, arguments), options);
		}
	};

	$('.cpfcnpj').mask(CCMaskBehavior, ccOptions, {clearIfNotMatch: true});
     
	
});
 
function moeda2float(moeda){
	moeda = moeda.replace(".","");
	moeda = moeda.replace(",",".");
	return parseFloat(moeda);
}

/*mascara para formatar numeros*/
function number_format( numero, decimal, decimal_separador, milhar_separador ){	
    numero = (numero + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+numero) ? 0 : +numero,
        prec = !isFinite(+decimal) ? 0 : Math.abs(decimal),
        sep = (typeof milhar_separador === 'undefined') ? ',' : milhar_separador,
        dec = (typeof decimal_separador === 'undefined') ? '.' : decimal_separador,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix para IE: parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }

    return s.join(dec);
}