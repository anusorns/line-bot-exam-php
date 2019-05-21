const functions = require("firebase-functions");
const request = require("request-promise");

const LINE_MESSAGING_API = "https://api.line.me/v2/bot/message";
const LINE_HEADER = {
  "Content-Type": "application/json",
  "Authorization": "Bearer <acI+Y9TOweOJVl+uPFFxr9sIOzN2A2khMx+Sz4OkSZqWCea1XDJ6fjjPh+9FihUi+VdsRSSXUqvjRsAB4C61QrCPFS09k2k0s2R9JH8vi1P5dkwP4Xrx/zkJ/EvRWCaK3OaV1gwrtkesqiYqEUmf4wdB04t89/1O/w1cDnyilFU=>"
};

exports.AdvanceMessage = functions.https.onRequest((req, res) => {
  return request({
    method: "POST",
    uri: `${LINE_MESSAGING_API}/push`,
    headers: LINE_HEADER,
    body: JSON.stringify({
      to: "<Ub135afd181c7f28674f1b52c60921345>",
      messages: [
        {
          type: "template",
          altText: "This is a buttons template",
          template: {
            type: "buttons",
            thumbnailImageUrl: "https://www.nylon.com.sg/wp-content/uploads/2017/07/LINE-Friends.jpg",
            imageAspectRatio: "rectangle",
            imageSize: "cover",
            imageBackgroundColor: "#FFFFFF",
            title: "Menu",
            text: "Please select",
            defaultAction: {
              type: "uri",
              label: "View detail",
              uri: "https://developers.line.biz"
            },
            actions: [
              {
                type: "postback",
                label: "Buy",
                data: "action=buy&itemid=123"
              },
              {
                type: "uri",
                label: "View detail",
                uri: "https://line.me"
              }
            ]
          }
        }
      ]
    })
  }).then(() => {
      return res.status(200).send("Done");
  }).catch(error => {
      return Promise.reject(error);
  });
});
