# MatrixCrypto
A matrix-based cryptographic algorithm

I made this a couple years ago based on a math exercise from my high school math class

## How it works

Basically, there is a 2x2 matrix ($A) that stores the key to encrypt and decrypt, which is composed of 4 integers.

Once you put the string to be encrypted/decrypted, it's ascii chars will be converted to decimal and splitted in order to form a Yx2 matrix ($B) (where Y = strlen(string)/2).

Matrix A and B are multiplied and the resulting matrix is stored in $C. This is the string encrypted. You could convert this integers to ascii or something to generate a string, but i didn't do that.

To decrypt, matrix C is multiplied by matrix A^-1 (the inverse matrix of A), which generates the B matrix again (which contains the decimal that corresponds to the ascii of the string).

![Screenshot](https://i.imgur.com/7iPiAcx.png)
