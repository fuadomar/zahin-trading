# Database changes
Run queries on project initialize:

    - ALTER TABLE ps_customer ADD COLUMN customer_type VARCHAR(20);
    - ALTER TABLE ps_customer ADD COLUMN business_type VARCHAR(255);
