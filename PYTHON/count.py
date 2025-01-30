def count(coins, n, sum):
    #if sum is 0 then there is 1
    #solution (do not include any coin)
    if (sum == 0):
        return 1
    #if sum is less than 0 then no 
    #solution exist
    if (sum < 0):
        return 0
    #if there are no coins and sum 
    #is greater than 0, then no
    #solution exist
    if (n <= 0):
        return 0
    #count is sum of solution (i)
    #including coins[n-1] (ii) excluding coins[n-1]
    return count(coins, n - 1, sum) + count(coins, n, sum-coins[n-1])

#Driver program to test above function
coins = [4, 5, 6]
n = len(coins)
print(count(coins, n, 5))