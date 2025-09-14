from flask import Flask
from flask_cors import CORS, cross_origin
from flask import json
from .email_send import email_send

app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

@cross_origin()
@app.route("/api/email", methods=['POST'])
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

@cross_origin()
@app.route("/api/email", methods=['GET'])
def sendEmail():
    # get data from json
    data = {"message": "this test passes"}

    # in request create new email

    response = app.response_class(
        response=json.dumps(data),
        status=200,
        mimetype='application/json'
    )
    return response

if __name__ == "__main__":
    app.run(host='0.0.0.0')
