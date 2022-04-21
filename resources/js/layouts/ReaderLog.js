import React, { useState, useEffect } from 'react'
import styled from 'styled-components'
import { isEmpty } from 'lodash'
import LogContainer from '../components/LogContainer'
import ReaderLogTable from '../components/tables/ReaderLogTable'
import ReaderSummaryTable from '../components/tables/ReaderSummaryTable'
import LinkedList from '../components/LinkedList'
import { H2, H3 } from '../components/Headings'
import { getLogs, getMilestones } from '../helpers/api'
import { second, hour } from '../helpers/time'

const MilestoneText = styled.p`
  color: ${props => props.theme.colors.akcBlue};
  text-align: center;
  font-weight: bold;
`

const ReaderLog = props => {
  const { user } = props

  const [isLoading, setIsLoading] = useState(true)
  const [logs, setLogs] = useState([])
  useEffect(() => {
    getLogs('reader', user.data.id, second * 5)
      .then(logs => {
        const logData = logs.map(log => {
          const date = new Date(log.log_date.replace(' ', 'T'))

          return {
            name: log.student_name,
            date: `${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`,
            location: log.location.description,
            dog: log.dog_name,
            bookRead: log.book_read,
            hours: log.hours,
            pages: log.pages,
            photo: log.media && log.media.url
          }
        })

        setLogs(logData)

        setIsLoading(false)
      })
  }, [])

  const [summary, setSummary] = useState([{
    readingEvents: 0,
    booksRead: 0,
    hoursRead: 0,
    pagesRead: 0
  }])
  const [milestoneHoursLeft, setMilestoneHoursLeft] = useState(0)
  useEffect(() => {
    if (isEmpty(logs)) return

    const books = logs.map(log => log.bookRead)
    const hoursRead = logs.reduce((acc, cur) => {
      acc += parseFloat(cur.hours)
      return acc
    }, 0)
    const pagesRead = logs.reduce((acc, cur) => {
      acc += cur.pages
      return acc
    }, 0)

    const summaryData = {
      readingEvents: logs.length,
      booksRead: books.length,
      pagesRead: pagesRead,
      hoursRead: Math.round(hoursRead * 100) / 100
    }

    setSummary([summaryData])

    getMilestones(summaryData.hoursRead, hour)
      .then(({ num_hours: hoursLeft }) =>
        setMilestoneHoursLeft(hoursLeft - summaryData.hoursRead)
      )
  }, [logs])

  return (
    <LogContainer {...props}>
      <H2>Reading Log</H2>
      <LinkedList items={[
        { to: '/readerentry', text: 'Add a New Visit' }
      ]} />
      <H3>Previous Visits</H3>
      <ReaderLogTable data={logs} loading={isLoading} />
      <H3>Summary</H3>
      <ReaderSummaryTable data={summary} />
      <MilestoneText>
        {`${milestoneHoursLeft} HOURS LEFT UNTIL YOUR NEXT REWARD!`}
      </MilestoneText>
    </LogContainer>
  )
}

export default ReaderLog
