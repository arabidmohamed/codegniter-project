$(function() {
    $("#smsMessage").keyup(function() {
        calculateChars()
    });
});

function calculateChars() {
    var maxArabicChar = 70;
    var maxEnglishChar = 160;
    var numOfCharsTyped = 0;
    var numOfTechincalMsgs = 0;
    var maxAllowedChars = 0;
    var max_message_count = 15;

    numOfCharsTyped = $("#smsMessage").val().length; //  + $("#smsMessage").val().split("\n").length - 1;
    var isEnglish = IsEnglish($("#smsMessage").val());
    if (isEnglish) {
        $("#smsMessage").css("direction", "ltr");
        if (numOfCharsTyped <= 160) maxEnglishChar = 160;
        else maxEnglishChar = 153;

        if (max_message_count == 1) maxEnglishChar = 160;
        if (max_message_count == 1 && numOfCharsTyped > 160) numOfCharsTyped = 160;

        numOfTechincalMsgs = Math.ceil(numOfCharsTyped / maxEnglishChar);

        if (numOfCharsTyped >= (maxEnglishChar * max_message_count)) {

            $("#smsMessage").val($("#smsMessage").val().substring(0, maxEnglishChar * max_message_count));
            numOfCharsTyped = maxEnglishChar * max_message_count;
            numOfTechincalMsgs = Math.ceil(numOfCharsTyped / maxEnglishChar);
            $("#max_messages_message").show("slow");
        } else {
            $("#max_messages_message").hide('slow');
        }

        maxAllowedChars = maxEnglishChar * 15;
        $("#char_cnt").html(numOfCharsTyped);

        $("#rest_char_cnt").html((numOfTechincalMsgs * maxEnglishChar) - numOfCharsTyped);



    } else {
        $("#smsMessage").css("direction", "rtl");
        if (numOfCharsTyped <= 70) maxArabicChar = 70;
        else maxArabicChar = 67;
        if (max_message_count == 1) maxArabicChar = 70;
        if (max_message_count == 1 && numOfCharsTyped > 70) numOfCharsTyped = 70;
        numOfTechincalMsgs = Math.ceil(numOfCharsTyped / maxArabicChar);
        if (numOfCharsTyped >= (maxArabicChar * max_message_count)) {
            $("#smsMessage").val($("#smsMessage").val().substring(0, maxArabicChar * max_message_count));
            numOfCharsTyped = maxArabicChar * max_message_count;
            numOfTechincalMsgs = Math.ceil(numOfCharsTyped / maxArabicChar);
            $("#max_messages_message").show("slow");
        } else {
            $("#max_messages_message").hide('slow');
        }
        maxAllowedChars = maxArabicChar * 15;
        $("#char_cnt").html(numOfCharsTyped);
        $("#rest_char_cnt").html((numOfTechincalMsgs * maxArabicChar) - numOfCharsTyped);


    }

    $("#msg_cnt").html(numOfTechincalMsgs);
}

function IsEnglish(inputString) {
    if (inputString.match('^[0-9A-Za-z" ,.!;:£?$&+=/_)(@#%*{}<>\'\n\r|\^\-]+$'))
    {
    	return true;
    }
    return false;
}