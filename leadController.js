


// this code expects a list of products like for example:
// cartToLeads = [
//     {code:'product-code', type: 'p-type', size: 'p-size', qty:'p-quantity'},
//     {code:'product-code', type: 'p-type', size: 'p-size', qty:'p-quantity'},
//     {code:'product-code', type: 'p-type', size: 'p-size', qty:'p-quantity'},
//     {code:'product-code', type: 'p-type', size: 'p-size', qty:'p-quantity'},
// ]

const sendAllLeads=()=>{
    let product = cartToLeads.shift();
    console.log('send '+product.qty+' product: ', product.code)
    

    let info = {
        fname:    d.querySelector('#inputNames').value,
        email:    d.querySelector('#inputEmail').value,
        phone:    d.querySelector('#inputPhone').value,
        country:  d.querySelector('#inputCountry').value,
        city:     d.querySelector('#inputCity').value,
        code:     product.code,
        type:     product.type,
        size:     product.size,
        quantity: product.qty,
        company:  '-',
        lname:    '-',
        message:  '-',
    }
    
    if(cartToLeads.length!=0){
        createCookie('cartToLeads', JSON.stringify(cartToLeads).split(';').join(':'));
        createCookie('info', JSON.stringify(info));
        createCookie('lastLead', 'waiting');
    } else {
        createCookie('lastLead', 'sent');
    }
    console.log(info)
    createCookie('leadsSent', '1');
    newLead(info);
}

const newLead=(info)=>{
    let first_name = info.fname;
    let last_name  = info.lname;
    let email      = info.email;
    let phone      = info.phone;
    let company    = info.company;
    let country    = info.country;
    let city       = info.city;
    let product    = info.code;
    let type       = info.type;
    let size       = info.size;
    let quantity   = info.quantity;
    let message    = info.message;

    let vars = '?first_name='+first_name+'&last_name='+last_name+'&email='+email+'&phone='+phone+'&company='+company+'&country='+country+'&city='+city+'&product='+product+'&type='+type+'&size='+size+'&quantity='+quantity+'&message='+message;

    let baseURL= 'https://your-website.com/testLead.php';
    let url = baseURL + vars;
    win2 = window.open(url,'_blank');

    // this part doesn't work for some reason,
    // it should open the other window in the background
    win2.blur();
    window.focus();
    //TODO: que la pagina que se abre se cierre... 
    checkForClose();
    
}



const checkForClose = ()=>{
	console.log(readCookie('allLeads')=='success')
    if(readCookie('allLeads')=='success'){
		// console.log('FOUNDDDD, close cycle')
		let cant = parseInt(readCookie('leadsSent'))
		console.log('cantidad de Leads enviados: ', cant)
		eraseCookie('allLeads')
		win2.close()
    } else {
		console.log(readCookie('status'))
		setTimeout(() => {
			checkForClose();
		}, 200);
    }
}


