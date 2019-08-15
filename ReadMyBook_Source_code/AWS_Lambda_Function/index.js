
var request = require("request")


// Route the incoming request based on type (LaunchRequest, IntentRequest,
// etc.) The JSON body of the request is provided in the event parameter.
exports.handler = function (event, context) {
    try {
        console.log("event.session.application.applicationId=" + event.session.application.applicationId);

        /**
         * Uncomment this if statement and populate with your skill's application ID to
         * prevent someone else from configuring a skill that sends requests to this function.
         */

     if (event.session.application.applicationId !== "amzn1.ask.skill.4fbcd3fb-286a-49ea-9915-468eee90e171") {
         context.fail("Invalid Application ID");
      }

        if (event.session.new) {
            onSessionStarted({requestId: event.request.requestId}, event.session);
        }

        if (event.request.type === "LaunchRequest") {
            onLaunch(event.request,
                event.session,
                function callback(sessionAttributes, speechletResponse) {
                    context.succeed(buildResponse(sessionAttributes, speechletResponse));
                });
        } else if (event.request.type === "IntentRequest") {
            onIntent(event.request,
                event.session,
                function callback(sessionAttributes, speechletResponse) {
                    context.succeed(buildResponse(sessionAttributes, speechletResponse));
                });
        } else if (event.request.type === "SessionEndedRequest") {
            onSessionEnded(event.request, event.session);
            context.succeed();
        }
    } catch (e) {
        context.fail("Exception: " + e);
    }
};


var bookIndex = 0;
var bookname;

/**
 * Called when the session starts.
 */
function onSessionStarted(sessionStartedRequest, session) {
    // add any session init logic here
}

/**
 * Called when the user invokes the skill without specifying what they want.
 */
function onLaunch(launchRequest, session, callback) {
    getWelcomeResponse(callback)
}

/**
 * Called when the user specifies an intent for this skill.
 */
function onIntent(intentRequest, session, callback) {

    var intent = intentRequest.intent
    var intentName = intentRequest.intent.name;

    //  custom intents to handlers here
    if (intentName == "GetInfoIntent") {
        handleGetInfoIntent(intent, session, callback)
    }else if (intentName == "GetBookName")    {
        handleGetBookName(intent, session,callback)
    }else if (intentName == "GetAuthor") {
        handleGetAuthorIntent(intent, session,callback)
    }else if (intentName == "AMAZON.CancelIntent") {
        handleFinishSessionRequest(intent, session, callback)
    }else if (intentName == "ReadByBookName") {
        handleReadByBookName(intent,session,callback)
    }else if (intentName == "GetCatalog") {
        handleGetCatalog(intent,session,callback)
    }else {
         throw "Invalid intent"
    }
}

/**
 * Called when the user ends the session.
 * Is not called when the skill returns shouldEndSession=true.
 */
function onSessionEnded(sessionEndedRequest, session) {

}

// ------- Skill specific logic -------

function getWelcomeResponse(callback) {
    var speechOutput = "Welcome to read my book! You can say ,read ,followed by the book name for me to start reading the book. To know which books are available say ,what books can you read?"
    var reprompt = "Do you want to hear about some books?"

    var header = "Get Info"

    var shouldEndSession = false

    var sessionAttributes = {
        "speechOutput" : speechOutput,
        "repromptText" : reprompt
    }

    callback(sessionAttributes, buildSpeechletResponse(header, speechOutput, reprompt, shouldEndSession))

}

function handleReadByBookName(intent,session,callback) {
    
    var speechOutput = "We have an error"
    
    var book = intent.slots.BookName.value.toLowerCase();
    
    getContentJSON(function(data) {
        if (data != "ERROR") {
            var speechOutput = data
        }
    
    var shouldEndSession = false
        callback(session.attributes, buildSpeechletResponseWithoutCard(speechOutput, "", false))
    },book)
}


function handleGetInfoIntent(intent, session, callback) {

    var speechOutput = "We have an error"

    getContentJSON(function(data) {
        if (data != "ERROR") {
            var speechOutput = data
        }
    //var books = intent.slots.BookName.value;
    var shouldEndSession = false
        callback(session.attributes, buildSpeechletResponseWithoutCard(speechOutput, "", false))
    })
   

}

function handleGetAuthorIntent(intent, session, callback) {

    var speechOutput = "We have an error"
    var book = intent.slots.BookName.value.toLowerCase();

    getAuthorJSON(function(data) {
        if (data != "ERROR") {
            var speechOutput = "The "+book +" was written by " + data
        }
    var shouldEndSession = false
        callback(session.attributes, buildSpeechletResponseWithoutCard(speechOutput, "", false))
    },book)
   

}

function handleGetBookName(intent, session, callback) {

    var speechOutput = "We have an error"

    getBookJSON(function(data) {
        if (data != "ERROR") {
            var speechOutput = data
        }
    var shouldEndSession = false
        callback(session.attributes, buildSpeechletResponseWithoutCard(speechOutput, "", false))
    })
    

}
//get available book names
function handleGetCatalog(intent,session,callback){
    
    var speechOutput = "Sorry, there are no books available, you can add the books from our website"

    getCatalogJSON(function(data) {
        if (data != "ERROR") {
            var speechOutput = "The available books are " + data
        }
       
    var shouldEndSession = false
        callback(session.attributes, buildSpeechletResponseWithoutCard(speechOutput, "", false))
    })
   
}




function url() {
    return "http://www.rushirajadeja.com/books.json"
}

function url1() {
    return "http://www.rushirajadeja.com/user_books.json"
}


//for content
function getContentJSON(callback,bookName=undefined) {
    
     request.get(url(), function(error, response, body) {
         var d = JSON.parse(body)
         if(bookName==undefined)
            var result = d.search[bookIndex].content;
         else{
             
             var result;
             d.search.forEach(function(e){
                 if(e.title.toLowerCase().includes(bookName))
                 {
                     
                     result=e.content;
                 }
             });
        
         }
         if (result !== "" && result.length !== 0) {
             callback(result);
         } else {
             callback("ERROR")
         }
     })

    
}
//for available books
function getCatalogJSON(callback) {
    
    request.get(url1(), function(error, response, body) {
         var d = JSON.parse(body)
         var result="";
         
         d.forEach(function(e)
         {
         result += e.book_name + " ,";
        
         });
         if (result !== "" && result.length !== 0) {
             callback(result);
         } else {
             callback("ERROR")
         }
     })
}


//for current book name
function getBookJSON(callback) {
    
     request.get(url(), function(error, response, body) {
         var d = JSON.parse(body)
         var result = d.search[bookIndex].title;
         
         if (result !== "" && result.length !== 0) {
             callback(result);
         } else {
             callback("ERROR")
         }
     })
} 

// for Author
function getAuthorJSON(callback,bookName=undefined) {
    
    request.get(url(), function(error, response, body) {
         var d = JSON.parse(body)
         if(bookName==undefined)
            var result = d.search[bookIndex].author;
         else{
             
             var result;
             d.search.forEach(function(e){
                 if(e.title.toLowerCase().includes(bookName))
                 {
                     
                     result=e.author;
                 }
             });
        
         }
         if (result !== "" && result.length !== 0) {
             callback(result);
         } else {
             callback("ERROR")
         }
     })
     

    
}
// cancel intent
function handleFinishSessionRequest(intent, session, callback) {
    // End the session with a "Good bye!" if the user wants to quit the game
    callback(session.attributes,
        buildSpeechletResponseWithoutCard("Good bye! Thank you for using Read my book", "", true));
}

// ------- Helper functions to build responses for Alexa -------


function buildSpeechletResponse(title, output, repromptText, shouldEndSession) {
    return {
        outputSpeech: {
            type: "PlainText",
            text: output
        },
        card: {
            type: "Simple",
            title: title,
            content: output
        },
        reprompt: {
            outputSpeech: {
                type: "PlainText",
                text: repromptText
            }
        },
        shouldEndSession: shouldEndSession
    };
}

function buildSpeechletResponseWithoutCard(output, repromptText, shouldEndSession) {
    return {
        outputSpeech: {
            type: "PlainText",
            text: output
        },
        reprompt: {
            outputSpeech: {
                type: "PlainText",
                text: repromptText
            }
        },
        shouldEndSession: shouldEndSession
    };
}

function buildResponse(sessionAttributes, speechletResponse) {
    return {
        version: "1.0",
        sessionAttributes: sessionAttributes,
        response: speechletResponse
    };
}

function capitalizeFirst(s) {
    return s.charAt(0).toUpperCase() + s.slice(1)
}
