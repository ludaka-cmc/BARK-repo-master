import React, { Component } from 'react'
import styled from 'styled-components'
import ReactTable from 'react-table'
import 'react-table/react-table.css'

const StyledTable = styled(ReactTable)`
  a {
    font-size: 16px;
  }
`

class Table extends Component {
  render () {
    const { columns, data, ...props } = this.props
    return (
      <StyledTable
        columns={columns}
        data={data}
        defaultPageSize={5}
        getTdProps={() => ({
          style: {
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            whiteSpace: 'normal'
          }
        })}
        {...props}
      />
    )
  }
}

export default Table
