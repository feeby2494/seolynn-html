from flask import Flask, request
from flask import json
from flask_cors import CORS, cross_origin
from email_send import email_send

app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

@cross_origin()
@app.route("/tools", methods=['GET'])
def sendEmailTest():
    # get data from json
    data = {"message": "this test passes"}

    # in request create new email
    return "<h1>dd</h1>"

@cross_origin()
@app.route("/tools/email", methods=['POST'])
def sendEmail():
    # get data from json
    data = request.get_json()

    # in request create new email
    sent_email = email_send(data["inputEmail"], data["issueDesc"])

    response = app.response_class(
        response=json.dumps({"message": sent_email}),
        status=200,
        mimetype='application/json'
    )
    return response

if __name__ == "__main__":
    app.run(host='0.0.0.0')
