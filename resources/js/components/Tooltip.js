import React, { useState } from 'react'
import { Manager, Reference, Popper } from 'react-popper'

const Tooltip = ({ pointContent, tooltipContent, id, ...props }) => {
  const [toggled, setToggled] = useState(false)

  return (
    <div
      onMouseEnter={() => setToggled(true)}
      onMouseLeave={() => setToggled(false)}
    >
      <Manager>
        <Reference>
          {({ ref }) => (
            <div
              ref={ref}
              tabIndex={0}
              aria-describedby={id}
            >
              {pointContent}
            </div>
          )}
        </Reference>
        <Popper
          modifiers={{ arrow: { enabled: false } }}
          {...props}
        >
          {({ ref, style }) => (
            <div
              role='tooltip'
              id={id}
              aria-hidden={!toggled}
              ref={ref}
              style={{
                visibility: toggled ? 'visible' : 'hidden',
                zIndex: 100,
                ...style
              }}
            >
              {tooltipContent}
            </div>
          )}
        </Popper>
      </Manager>
    </div>
  )
}

export default Tooltip
