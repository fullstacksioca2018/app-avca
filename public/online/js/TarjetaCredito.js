// Create an object
var creditCardValidator = {};
// Pin the cards to them
creditCardValidator.cards = {
        'mc':'5[1-5][0-9]{14}',
        'ec':'5[1-5][0-9]{14}',
        'vi':'4(?:[0-9]{12}|[0-9]{15})',
        'ax':'3[47][0-9]{13}',
        'dc':'3(?:0[0-5][0-9]{11}|[68][0-9]{12})',
        'bl':'3(?:0[0-5][0-9]{11}|[68][0-9]{12})',
        'di':'6011[0-9]{12}',
        'jcb':'(?:3[0-9]{15}|(2131|1800)[0-9]{11})',
        'er':'2(?:014|149)[0-9]{11}'
};
// Add the card validator to them
creditCardValidator.validate = function(value,ccType) {
        value = String(value).replace(/[- ]/g,''); //ignore dashes and whitespaces

        var cardinfo = creditCardValidator.cards, results = [];
        if(ccType){
                var expr = '^' + cardinfo[ccType.toLowerCase()] + '$';
                return expr ? !!value.match(expr) : false; // boolean
        }

        for(var p in cardinfo){
                if(value.match('^' + cardinfo[p] + '$')){
                        results.push(p);
                }
        }
        return results.length ? results.join('|') : false; // String | boolean
};

if(!creditCardValidator.validate(document.id("creditCardField"))) {
        alert("Invalid credit card!");
}