openapi: 3.0.0
info:
  title: 'Swagger Petstore'
  description: "This is a sample Petstore server.  You can find\nout more about Swagger at\n[http://swagger.io](http://swagger.io) or on\n[irc.freenode.net, #swagger](http://swagger.io/irc/)."
  termsOfService: 'http://swagger.io/terms/'
  contact:
    email: apiteam@swagger.io
  license:
    name: 'Apache 2.0'
    url: 'http://www.apache.org/licenses/LICENSE-2.0.html'
  version: 1.0.0
paths:
  /pet:
    post:
      tags:
        - pet
      summary: 'Add a new pet to the store'
      operationId: addPet
      requestBody:
        $ref: '#/components/requestBodies/Pet'
      responses:
        '405':
          description: 'Invalid input'
      security:
        -
          petstore_auth:
            - 'write:pets'
            - 'read:pets'
