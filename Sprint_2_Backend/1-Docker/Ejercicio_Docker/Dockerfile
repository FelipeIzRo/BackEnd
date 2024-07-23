FROM python:3.12.3

WORKDIR /app

COPY ./app /app

RUN apt-get update
RUN apt-get install default-mysql-client -y
RUN pip install --no-cache-dir -r /app/requirements.txt

EXPOSE 5000

CMD ["flask", "run" ,"--host=0.0.0.0", "--port=5000"]


