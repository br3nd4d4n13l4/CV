import heapq
from collections import defaultdict, Counter

class Node:
    def __init__(self, char, freq):
        self.char = char
        self.freq = freq
        self.left = None
        self.right = None

    def __lt__(self, other):
        return self.freq < other.freq

def build_huffman_tree(text):
    frequency = Counter(text)
    priority_queue = [Node(char, freq) for char, freq in frequency.items()]
    heapq.heapify(priority_queue)
    
    while len(priority_queue) > 1:
        left_node = heapq.heappop(priority_queue)
        right_node = heapq.heappop(priority_queue)
        merged_node = Node(None, left_node.freq + right_node.freq)
        merged_node.left = left_node
        merged_node.right = right_node
        heapq.heappush(priority_queue, merged_node)

    return priority_queue[0]

def build_huffman_codes(node, current_code='', codes={}):
    if node is not None:
        if node.char is not None:
            codes[node.char] = current_code
        build_huffman_codes(node.left, current_code + '0', codes)
        build_huffman_codes(node.right, current_code + '1', codes)
    return codes

def huffman_encoding(text):
    if len(text) == 0:
        return "", None

    root = build_huffman_tree(text)
    codes = build_huffman_codes(root)
    #print(codes)
    encoded_text = ''.join([codes[char] for char in text])
    return encoded_text, root

def huffman_decoding(encoded_text, root):
    if len(encoded_text) == 0:
        return ""

    decoded_text = ''
    current_node = root
    for bit in encoded_text:
        if bit == '0':
            current_node = current_node.left
        else:
            current_node = current_node.right
        if current_node.char is not None:
            decoded_text += current_node.char
            current_node = root
    return decoded_text

# Example usage:
if __name__ == "__main__":
    text = "bryan"
    encoded_text, tree = huffman_encoding(text)
    print("Encoded text:", encoded_text)
    decoded_text = huffman_decoding(encoded_text, tree)
    print("Decoded text:", decoded_text)
