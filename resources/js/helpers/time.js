const second = 1000

const minute = second * 60

const hour = minute * 60

const day = hour * 24

const week = day * 7

const month = week * 4

const fromNow = time => new Date().getTime() + time

export { second, minute, hour, day, week, month, fromNow }
