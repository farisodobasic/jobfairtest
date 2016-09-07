jQuery.extend(jQuery.validator.messages, {
    required: "Molimo popunite ovo polje.",
    email: "Molimo unesite ispravnu email adresu (someone@example.com).",
    url: "Molimo unesite ispravan URL (http://..., https://...).",
    date: "Molimo unesite ispravan datum.",
    maxlength: jQuery.validator.format("Ovo polje ne može sadržati više od {0} karaktera."),
    minlength: jQuery.validator.format("Ovo polje mora sadržati minimalno {0} karaktera.")
});