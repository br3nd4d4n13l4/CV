import time

#Dynamic Programming Python implementation of Coin
#Change problem

def count(coins, n, sum):
    #dp[i] will be storing the number of solutions for
    #value i. We need sum+1 rows as the dp is constructed
    #in bottom up manner using the base case (sum = 0)
    #Initialize all table values as 0
    dp = [0 for k in range(sum+1)]
    #Base case (if given value is 0)
    dp[0] = 1
    #Pick all coins one and update the dp[] values
    #after the index greater than or equal to the value of the 
    #picked coin
    for i in range(0, n):
        for j in range(coins[i], sum+1):
            dp[j] += dp[j-coins[i]]
    return dp[sum]
#Driver program to test above function
coins = [1, 2, 3]
n = len(coins)
sum = 5

start_time = time.time()
x = count(coins, n, sum)
end_time = time.time()

print("Number of ways to make change:",x)
print("Execution time:",end_time - start_time, "seconds")