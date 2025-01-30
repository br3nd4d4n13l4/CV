import time

def count(coins, sum, n, dp):
    if (sum == 0):
        dp[n][sum] = 1
        return dp[n][sum]
    if (n == 0  or sum < 0):
        return 0
    if (dp[n][sum] != -1):
        return dp[n][sum]
    dp[n][sum] = count(coins, sum - coins[n - 1], n, dp) + count(coins, sum, n - 1, dp)
    return dp[n][sum]

if __name__=='__main__':
    tc = 1
    while (tc != 0):
        n = 3
        sum = 5
        coins = [1, 2, 3]
        dp = [[-1 for i in range(sum+1)] for j in range(n+1)]
        
        start_time = time.time()
        res = count(coins, sum, n, dp)
        end_time = time.time()

        print("Number of ways to make change:", res)
        print("Execution time:", end_time - start_time, "seconds")

        tc -= 1
