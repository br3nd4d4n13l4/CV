def text_to_binary(text):
    binary_string = ""
    for char in text:
            binary_char = bin(ord(char))[2:].zfill(8)
            binary_string += binary_char + ""
    return binary_string.strip()
def main():
    text = input("Enter text to convert to binary: ")
    binary_text = text_to_binary(text)
    print("Binary representation: ",binary_text)
if __name__ == "__main__":
     main()