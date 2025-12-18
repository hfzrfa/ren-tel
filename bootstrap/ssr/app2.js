import axios from "axios";
import { jsx, jsxs } from "react/jsx-runtime";
import * as React from "react";
import React__default, { useMemo, useRef, Children, cloneElement, useState, useEffect } from "react";
import { createRoot } from "react-dom/client";
import { useMotionValue, useTransform, useSpring, motion, AnimatePresence } from "motion/react";
import { createPortal } from "react-dom";
import { ChevronLeftIcon, ChevronRightIcon, ChevronDownIcon } from "lucide-react";
import { Slot } from "@radix-ui/react-slot";
import { cva } from "class-variance-authority";
import { clsx } from "clsx";
import { twMerge } from "tailwind-merge";
import { getDefaultClassNames, DayPicker } from "react-day-picker";
import * as LabelPrimitive from "@radix-ui/react-label";
import * as PopoverPrimitive from "@radix-ui/react-popover";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
function DockItem({
  children,
  onClick,
  className = "",
  mouseX,
  spring,
  distance,
  magnification,
  baseItemSize
}) {
  const ref = useRef(null);
  const isHovered = useMotionValue(0);
  const mouseDistance = useTransform(mouseX, (val) => {
    const rect = ref.current?.getBoundingClientRect() ?? {
      x: 0
    };
    return val - rect.x - baseItemSize / 2;
  });
  const targetSize = useTransform(
    mouseDistance,
    [-distance, 0, distance],
    [baseItemSize, magnification, baseItemSize]
  );
  const size = useSpring(targetSize, spring);
  return /* @__PURE__ */ jsx(
    motion.div,
    {
      ref,
      style: { width: size, height: size },
      onHoverStart: () => isHovered.set(1),
      onHoverEnd: () => isHovered.set(0),
      onFocus: () => isHovered.set(1),
      onBlur: () => isHovered.set(0),
      onClick,
      className: `relative inline-flex items-center justify-center rounded-full bg-[#060010] border-neutral-700 border-2 shadow-md ${className}`,
      tabIndex: 0,
      role: "button",
      "aria-haspopup": "true",
      children: Children.map(
        children,
        (child) => React__default.isValidElement(child) ? cloneElement(child, { isHovered }) : child
      )
    }
  );
}
function DockLabel({ children, className = "", isHovered }) {
  const [isVisible, setIsVisible] = useState(false);
  useEffect(() => {
    if (!isHovered) return;
    const unsubscribe = isHovered.on("change", (latest) => {
      setIsVisible(latest === 1);
    });
    return () => unsubscribe?.();
  }, [isHovered]);
  return /* @__PURE__ */ jsx(AnimatePresence, { children: isVisible && /* @__PURE__ */ jsx(
    motion.div,
    {
      initial: { opacity: 0, y: 0 },
      animate: { opacity: 1, y: -10 },
      exit: { opacity: 0, y: 0 },
      transition: { duration: 0.2 },
      className: `${className} absolute -top-6 left-1/2 w-fit whitespace-pre rounded-md border border-neutral-700 bg-[#060010] px-2 py-0.5 text-xs text-white`,
      role: "tooltip",
      style: { x: "-50%" },
      children
    }
  ) });
}
function DockIcon({ children, className = "" }) {
  return /* @__PURE__ */ jsx("div", { className: `flex items-center justify-center ${className}`, children });
}
function Dock({
  items,
  className = "",
  spring = { mass: 0.1, stiffness: 150, damping: 12 },
  magnification = 70,
  distance = 200,
  panelHeight = 64,
  dockHeight = 256,
  baseItemSize = 50,
  // If set (in pixels), this will move the dock up from the bottom by the given amount.
  // When provided, it overrides the default Tailwind bottom-2 class via inline style.
  offsetBottom = null
}) {
  const mouseX = useMotionValue(Infinity);
  const isHovered = useMotionValue(0);
  const maxHeight = useMemo(
    () => Math.max(dockHeight, magnification + magnification / 2 + 4),
    [dockHeight, magnification]
  );
  const heightRow = useTransform(isHovered, [0, 1], [panelHeight, maxHeight]);
  const height = useSpring(heightRow, spring);
  const dockNode = /* @__PURE__ */ jsx(
    motion.div,
    {
      style: { height, scrollbarWidth: "none" },
      className: "mx-2 flex max-w-full items-center",
      children: /* @__PURE__ */ jsx(
        motion.div,
        {
          onMouseMove: ({ pageX }) => {
            isHovered.set(1);
            mouseX.set(pageX);
          },
          onMouseLeave: () => {
            isHovered.set(0);
            mouseX.set(Infinity);
          },
          className: `fixed ${offsetBottom == null ? "bottom-6" : ""} left-1/2 -translate-x-1/2 transform flex items-end w-fit gap-4 rounded-2xl border-neutral-700 border-2 pb-2 px-4 backdrop-blur bg-black/10 ${className}`,
          style: {
            height: panelHeight,
            ...offsetBottom != null ? { bottom: offsetBottom } : {}
          },
          role: "toolbar",
          "aria-label": "Application dock",
          children: items.map((item, index) => /* @__PURE__ */ jsxs(
            DockItem,
            {
              onClick: item.onClick,
              className: item.className,
              mouseX,
              spring,
              distance,
              magnification,
              baseItemSize,
              children: [
                /* @__PURE__ */ jsx(DockIcon, { children: item.icon }),
                /* @__PURE__ */ jsx(DockLabel, { children: item.label })
              ]
            },
            index
          ))
        }
      )
    }
  );
  return createPortal(dockNode, document.body);
}
function HomeIcon(props) {
  return /* @__PURE__ */ jsx("svg", { viewBox: "0 0 24 24", fill: "currentColor", className: "h-6 w-6 text-white", "aria-hidden": "true", ...props, children: /* @__PURE__ */ jsx("path", { d: "M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z" }) });
}
function CarIcon(props) {
  return /* @__PURE__ */ jsx("svg", { viewBox: "0 0 24 24", fill: "currentColor", className: "h-6 w-6 text-white", "aria-hidden": "true", ...props, children: /* @__PURE__ */ jsx("path", { d: "M5 11l1-3a3 3 0 012.83-2h6.34A3 3 0 0118 8l1 3h1a1 1 0 110 2h-1v4a1 1 0 11-2 0v-1H8v1a1 1 0 11-2 0v-4H5a1 1 0 110-2h0zM7 16h10v-3H7v3zm1.5-8a1.5 1.5 0 100 3h7a1.5 1.5 0 100-3h-7z" }) });
}
function UserIcon(props) {
  return /* @__PURE__ */ jsx("svg", { viewBox: "0 0 24 24", fill: "currentColor", className: "h-6 w-6 text-white", "aria-hidden": "true", ...props, children: /* @__PURE__ */ jsx("path", { d: "M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 1114 0H5z" }) });
}
function LogoutIcon(props) {
  return /* @__PURE__ */ jsx("svg", { viewBox: "0 0 24 24", fill: "currentColor", className: "h-6 w-6 text-white", "aria-hidden": "true", ...props, children: /* @__PURE__ */ jsx("path", { d: "M16 17l5-5-5-5v3H9v4h7v3zM4 4h8a1 1 0 110 2H6v12h6a1 1 0 110 2H4a1 1 0 01-1-1V5a1 1 0 011-1z" }) });
}
function mountDock() {
  const el = document.getElementById("react-dock");
  if (!el) return;
  const home = el.dataset.home || "/";
  const book = el.dataset.book || "/book";
  const profile = el.dataset.profile || "/login";
  const items = [
    {
      icon: /* @__PURE__ */ jsx(HomeIcon, {}),
      label: "Home",
      onClick: () => window.location.href = home
    },
    {
      icon: /* @__PURE__ */ jsx(CarIcon, {}),
      label: "Book",
      onClick: () => window.location.href = book
    },
    {
      icon: /* @__PURE__ */ jsx(UserIcon, {}),
      label: "Profile",
      onClick: () => window.location.href = profile
    },
    {
      icon: /* @__PURE__ */ jsx(LogoutIcon, {}),
      label: "Logout",
      onClick: () => {
        const form = document.getElementById("logout-form");
        if (form) form.submit();
        else window.location.href = home;
      }
    }
  ];
  const root = createRoot(el);
  root.render(/* @__PURE__ */ jsx(Dock, { items, className: "md:hidden", offsetBottom: 24 }));
}
document.addEventListener("DOMContentLoaded", mountDock);
function SpotlightCard({
  children,
  className = "",
  spotlightColor = "rgba(255, 255, 255, 0.25)"
}) {
  const divRef = useRef(null);
  const [isFocused, setIsFocused] = useState(false);
  const [position, setPosition] = useState({ x: 0, y: 0 });
  const [opacity, setOpacity] = useState(0);
  const handleMouseMove = (e) => {
    if (!divRef.current || isFocused) return;
    const rect = divRef.current.getBoundingClientRect();
    setPosition({ x: e.clientX - rect.left, y: e.clientY - rect.top });
  };
  const handleFocus = () => {
    setIsFocused(true);
    setOpacity(0.6);
  };
  const handleBlur = () => {
    setIsFocused(false);
    setOpacity(0);
  };
  const handleMouseEnter = () => setOpacity(0.6);
  const handleMouseLeave = () => setOpacity(0);
  return /* @__PURE__ */ jsxs(
    "div",
    {
      ref: divRef,
      onMouseMove: handleMouseMove,
      onFocus: handleFocus,
      onBlur: handleBlur,
      onMouseEnter: handleMouseEnter,
      onMouseLeave: handleMouseLeave,
      className: `relative overflow-hidden rounded-3xl border border-neutral-800 bg-neutral-900 p-6 sm:p-8 ${className}`,
      tabIndex: 0,
      children: [
        /* @__PURE__ */ jsx(
          "div",
          {
            className: "pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-500 ease-in-out",
            style: {
              opacity,
              background: `radial-gradient(circle at ${position.x}px ${position.y}px, ${spotlightColor}, transparent 80%)`
            }
          }
        ),
        children
      ]
    }
  );
}
function Benefit({ title, desc, icon }) {
  return /* @__PURE__ */ jsxs("div", { className: "flex flex-col", children: [
    /* @__PURE__ */ jsx("div", { className: "mb-3 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400", children: icon }),
    /* @__PURE__ */ jsx("h3", { className: "text-base font-semibold text-white", children: title }),
    /* @__PURE__ */ jsx("p", { className: "mt-1 text-sm text-slate-300", children: desc })
  ] });
}
function ShieldIcon() {
  return /* @__PURE__ */ jsx(
    "svg",
    {
      className: "h-5 w-5",
      viewBox: "0 0 24 24",
      fill: "none",
      stroke: "currentColor",
      strokeWidth: "2",
      strokeLinecap: "round",
      strokeLinejoin: "round",
      "aria-hidden": true,
      children: /* @__PURE__ */ jsx("path", { d: "M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" })
    }
  );
}
function CheckIcon() {
  return /* @__PURE__ */ jsx(
    "svg",
    {
      className: "h-5 w-5",
      viewBox: "0 0 24 24",
      fill: "none",
      stroke: "currentColor",
      strokeWidth: "2",
      strokeLinecap: "round",
      strokeLinejoin: "round",
      "aria-hidden": true,
      children: /* @__PURE__ */ jsx("path", { d: "M5 13l4 4L19 7" })
    }
  );
}
function GridIcon() {
  return /* @__PURE__ */ jsx(
    "svg",
    {
      className: "h-5 w-5",
      viewBox: "0 0 24 24",
      fill: "none",
      stroke: "currentColor",
      strokeWidth: "2",
      strokeLinecap: "round",
      strokeLinejoin: "round",
      "aria-hidden": true,
      children: /* @__PURE__ */ jsx("path", { d: "M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z" })
    }
  );
}
function BoltIcon() {
  return /* @__PURE__ */ jsx(
    "svg",
    {
      className: "h-5 w-5",
      viewBox: "0 0 24 24",
      fill: "none",
      stroke: "currentColor",
      strokeWidth: "2",
      strokeLinecap: "round",
      strokeLinejoin: "round",
      "aria-hidden": true,
      children: /* @__PURE__ */ jsx("path", { d: "M22 12h-4l-3 9L9 3 6 12H2" })
    }
  );
}
function BenefitsGrid() {
  const items = [
    {
      title: "All‑risk coverage",
      desc: "Drive with peace of mind with comprehensive insurance on every booking.",
      icon: /* @__PURE__ */ jsx(ShieldIcon, {})
    },
    {
      title: "Transparent pricing",
      desc: "No surprises at checkout—what you see is what you pay.",
      icon: /* @__PURE__ */ jsx(CheckIcon, {})
    },
    {
      title: "Flexible pickup",
      desc: "Choose airports, city hubs, or door‑to‑door delivery in select areas.",
      icon: /* @__PURE__ */ jsx(GridIcon, {})
    },
    {
      title: "Top‑rated fleet",
      desc: "From efficient EVs to luxury SUVs, all impeccably maintained.",
      icon: /* @__PURE__ */ jsx(BoltIcon, {})
    }
  ];
  return /* @__PURE__ */ jsx(
    "section",
    {
      id: "benefits",
      className: "mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:py-16",
      children: /* @__PURE__ */ jsx("div", { className: "grid gap-8 md:grid-cols-4", children: items.map((it, i) => /* @__PURE__ */ jsx(
        SpotlightCard,
        {
          className: "bg-neutral-900/90 border-neutral-800",
          children: /* @__PURE__ */ jsx(
            Benefit,
            {
              title: it.title,
              desc: it.desc,
              icon: it.icon
            }
          )
        },
        i
      )) })
    }
  );
}
function mountBenefits() {
  const el = document.getElementById("react-benefits");
  if (!el) return;
  const root = createRoot(el);
  root.render(/* @__PURE__ */ jsx(BenefitsGrid, {}));
}
document.addEventListener("DOMContentLoaded", mountBenefits);
function cn(...inputs) {
  return twMerge(clsx(inputs));
}
const buttonVariants = cva(
  "inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0",
  {
    variants: {
      variant: {
        default: "bg-primary text-primary-foreground hover:bg-primary/90",
        destructive: "bg-destructive text-destructive-foreground hover:bg-destructive/90",
        outline: "border border-input bg-background hover:bg-accent hover:text-accent-foreground",
        secondary: "bg-secondary text-secondary-foreground hover:bg-secondary/80",
        ghost: "hover:bg-accent hover:text-accent-foreground",
        link: "text-primary underline-offset-4 hover:underline"
      },
      size: {
        default: "h-10 px-4 py-2",
        sm: "h-9 rounded-md px-3",
        lg: "h-11 rounded-md px-8",
        icon: "h-10 w-10"
      }
    },
    defaultVariants: {
      variant: "default",
      size: "default"
    }
  }
);
const Button = React.forwardRef(
  ({ className, variant, size, asChild = false, ...props }, ref) => {
    const Comp = asChild ? Slot : "button";
    return /* @__PURE__ */ jsx(
      Comp,
      {
        className: cn(buttonVariants({ variant, size, className })),
        ref,
        ...props
      }
    );
  }
);
Button.displayName = "Button";
function Calendar({
  className,
  classNames,
  showOutsideDays = true,
  captionLayout = "label",
  buttonVariant = "ghost",
  formatters,
  components,
  ...props
}) {
  const defaultClassNames = getDefaultClassNames();
  return /* @__PURE__ */ jsx(
    DayPicker,
    {
      showOutsideDays,
      className: cn(
        "bg-background group/calendar p-3 [--cell-size:2rem] [[data-slot=card-content]_&]:bg-transparent [[data-slot=popover-content]_&]:bg-transparent",
        String.raw`rtl:**:[.rdp-button\_next>svg]:rotate-180`,
        String.raw`rtl:**:[.rdp-button\_previous>svg]:rotate-180`,
        className
      ),
      captionLayout,
      formatters: {
        formatMonthDropdown: (date) => date.toLocaleString("default", { month: "short" }),
        ...formatters
      },
      classNames: {
        root: cn("w-fit", defaultClassNames.root),
        months: cn(
          "relative flex flex-col gap-4 md:flex-row",
          defaultClassNames.months
        ),
        month: cn("flex w-full flex-col gap-4", defaultClassNames.month),
        nav: cn(
          "absolute inset-x-0 top-0 flex w-full items-center justify-between gap-1",
          defaultClassNames.nav
        ),
        button_previous: cn(
          buttonVariants({ variant: buttonVariant }),
          "h-[--cell-size] w-[--cell-size] select-none p-0 aria-disabled:opacity-50",
          defaultClassNames.button_previous
        ),
        button_next: cn(
          buttonVariants({ variant: buttonVariant }),
          "h-[--cell-size] w-[--cell-size] select-none p-0 aria-disabled:opacity-50",
          defaultClassNames.button_next
        ),
        month_caption: cn(
          "flex h-[--cell-size] w-full items-center justify-center px-[--cell-size]",
          defaultClassNames.month_caption
        ),
        dropdowns: cn(
          "flex h-[--cell-size] w-full items-center justify-center gap-1.5 text-sm font-medium",
          defaultClassNames.dropdowns
        ),
        dropdown_root: cn(
          "has-focus:border-ring border-input shadow-xs has-focus:ring-ring/50 has-focus:ring-[3px] relative rounded-md border",
          defaultClassNames.dropdown_root
        ),
        dropdown: cn(
          "bg-popover absolute inset-0 opacity-0",
          defaultClassNames.dropdown
        ),
        caption_label: cn(
          "select-none font-medium",
          captionLayout === "label" ? "text-sm" : "[&>svg]:text-muted-foreground flex h-8 items-center gap-1 rounded-md pl-2 pr-1 text-sm [&>svg]:size-3.5",
          defaultClassNames.caption_label
        ),
        table: "w-full border-collapse",
        weekdays: cn("flex", defaultClassNames.weekdays),
        weekday: cn(
          "text-muted-foreground flex-1 select-none rounded-md text-[0.8rem] font-normal",
          defaultClassNames.weekday
        ),
        week: cn("mt-2 flex w-full", defaultClassNames.week),
        week_number_header: cn(
          "w-[--cell-size] select-none",
          defaultClassNames.week_number_header
        ),
        week_number: cn(
          "text-muted-foreground select-none text-[0.8rem]",
          defaultClassNames.week_number
        ),
        day: cn(
          "group/day relative aspect-square h-full w-full select-none p-0 text-center [&:first-child[data-selected=true]_button]:rounded-l-md [&:last-child[data-selected=true]_button]:rounded-r-md",
          defaultClassNames.day
        ),
        range_start: cn(
          "bg-accent rounded-l-md",
          defaultClassNames.range_start
        ),
        range_middle: cn("rounded-none", defaultClassNames.range_middle),
        range_end: cn("bg-accent rounded-r-md", defaultClassNames.range_end),
        today: cn(
          "bg-accent text-accent-foreground rounded-md data-[selected=true]:rounded-none",
          defaultClassNames.today
        ),
        outside: cn(
          "text-muted-foreground aria-selected:text-muted-foreground",
          defaultClassNames.outside
        ),
        disabled: cn(
          "text-muted-foreground opacity-50",
          defaultClassNames.disabled
        ),
        hidden: cn("invisible", defaultClassNames.hidden),
        ...classNames
      },
      components: {
        Root: ({ className: className2, rootRef, ...props2 }) => {
          return /* @__PURE__ */ jsx(
            "div",
            {
              "data-slot": "calendar",
              ref: rootRef,
              className: cn(className2),
              ...props2
            }
          );
        },
        Chevron: ({ className: className2, orientation, ...props2 }) => {
          if (orientation === "left") {
            return /* @__PURE__ */ jsx(ChevronLeftIcon, { className: cn("size-4", className2), ...props2 });
          }
          if (orientation === "right") {
            return /* @__PURE__ */ jsx(
              ChevronRightIcon,
              {
                className: cn("size-4", className2),
                ...props2
              }
            );
          }
          return /* @__PURE__ */ jsx(ChevronDownIcon, { className: cn("size-4", className2), ...props2 });
        },
        DayButton: CalendarDayButton,
        WeekNumber: ({ children, ...props2 }) => {
          return /* @__PURE__ */ jsx("td", { ...props2, children: /* @__PURE__ */ jsx("div", { className: "flex size-[--cell-size] items-center justify-center text-center", children }) });
        },
        ...components
      },
      ...props
    }
  );
}
function CalendarDayButton({
  className,
  day,
  modifiers,
  ...props
}) {
  const defaultClassNames = getDefaultClassNames();
  const ref = React.useRef(null);
  React.useEffect(() => {
    if (modifiers.focused) ref.current?.focus();
  }, [modifiers.focused]);
  return /* @__PURE__ */ jsx(
    Button,
    {
      ref,
      variant: "ghost",
      size: "icon",
      "data-day": day.date.toLocaleDateString(),
      "data-selected-single": modifiers.selected && !modifiers.range_start && !modifiers.range_end && !modifiers.range_middle,
      "data-range-start": modifiers.range_start,
      "data-range-end": modifiers.range_end,
      "data-range-middle": modifiers.range_middle,
      className: cn(
        "data-[selected-single=true]:bg-primary data-[selected-single=true]:text-primary-foreground data-[range-middle=true]:bg-accent data-[range-middle=true]:text-accent-foreground data-[range-start=true]:bg-primary data-[range-start=true]:text-primary-foreground data-[range-end=true]:bg-primary data-[range-end=true]:text-primary-foreground group-data-[focused=true]/day:border-ring group-data-[focused=true]/day:ring-ring/50 flex aspect-square h-auto w-full min-w-[--cell-size] flex-col gap-1 font-normal leading-none data-[range-end=true]:rounded-md data-[range-middle=true]:rounded-none data-[range-start=true]:rounded-md group-data-[focused=true]/day:relative group-data-[focused=true]/day:z-10 group-data-[focused=true]/day:ring-[3px] [&>span]:text-xs [&>span]:opacity-70",
        defaultClassNames.day,
        className
      ),
      ...props
    }
  );
}
const Input = React.forwardRef(
  ({ className, type, ...props }, ref) => {
    return /* @__PURE__ */ jsx(
      "input",
      {
        type,
        className: cn(
          "flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm",
          className
        ),
        ref,
        ...props
      }
    );
  }
);
Input.displayName = "Input";
const labelVariants = cva(
  "text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
);
const Label = React.forwardRef(({ className, ...props }, ref) => /* @__PURE__ */ jsx(
  LabelPrimitive.Root,
  {
    ref,
    className: cn(labelVariants(), className),
    ...props
  }
));
Label.displayName = LabelPrimitive.Root.displayName;
const Popover = PopoverPrimitive.Root;
const PopoverTrigger = PopoverPrimitive.Trigger;
const PopoverContent = React.forwardRef(({ className, align = "center", sideOffset = 4, ...props }, ref) => /* @__PURE__ */ jsx(PopoverPrimitive.Portal, { children: /* @__PURE__ */ jsx(
  PopoverPrimitive.Content,
  {
    ref,
    align,
    sideOffset,
    className: cn(
      "z-50 w-72 rounded-md border bg-popover p-4 text-popover-foreground shadow-md outline-none data-[state=open]:animate-in data-[state=closed]:animate-out data-[state=closed]:fade-out-0 data-[state=open]:fade-in-0 data-[state=closed]:zoom-out-95 data-[state=open]:zoom-in-95 data-[side=bottom]:slide-in-from-top-2 data-[side=left]:slide-in-from-right-2 data-[side=right]:slide-in-from-left-2 data-[side=top]:slide-in-from-bottom-2 origin-[--radix-popover-content-transform-origin]",
      className
    ),
    ...props
  }
) }));
PopoverContent.displayName = PopoverPrimitive.Content.displayName;
function Calendar24() {
  const [open, setOpen] = React.useState(false);
  const [date, setDate] = React.useState(void 0);
  return /* @__PURE__ */ jsxs("div", { className: "flex gap-4", children: [
    /* @__PURE__ */ jsxs("div", { className: "flex flex-col gap-3", children: [
      /* @__PURE__ */ jsx(Label, { htmlFor: "date-picker", className: "px-1", children: "Date" }),
      /* @__PURE__ */ jsxs(Popover, { open, onOpenChange: setOpen, children: [
        /* @__PURE__ */ jsx(PopoverTrigger, { asChild: true, children: /* @__PURE__ */ jsxs(
          Button,
          {
            variant: "outline",
            id: "date-picker",
            className: "w-32 justify-between font-normal",
            children: [
              date ? date.toLocaleDateString() : "Select date",
              /* @__PURE__ */ jsx(ChevronDownIcon, {})
            ]
          }
        ) }),
        /* @__PURE__ */ jsx(
          PopoverContent,
          {
            className: "w-auto overflow-hidden p-0",
            align: "start",
            children: /* @__PURE__ */ jsx(
              Calendar,
              {
                mode: "single",
                selected: date,
                captionLayout: "dropdown",
                onSelect: (date2) => {
                  setDate(date2);
                  setOpen(false);
                }
              }
            )
          }
        )
      ] })
    ] }),
    /* @__PURE__ */ jsxs("div", { className: "flex flex-col gap-3", children: [
      /* @__PURE__ */ jsx(Label, { htmlFor: "time-picker", className: "px-1", children: "Time" }),
      /* @__PURE__ */ jsx(
        Input,
        {
          type: "time",
          id: "time-picker",
          step: "1",
          defaultValue: "10:30:00",
          className: "bg-background appearance-none [&::-webkit-calendar-picker-indicator]:hidden [&::-webkit-calendar-picker-indicator]:appearance-none"
        }
      )
    ] })
  ] });
}
const mount = document.getElementById("react-date-pickers");
if (mount) {
  createRoot(mount).render(/* @__PURE__ */ jsx(Calendar24, {}));
}
const STORAGE_KEY = "rentel-theme";
const mediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
const readStoredTheme = () => {
  try {
    const stored = localStorage.getItem(STORAGE_KEY);
    if (stored === "dark" || stored === "light") {
      return stored;
    }
  } catch (_err) {
  }
  return null;
};
const resolveTheme = () => {
  const stored = readStoredTheme();
  if (stored) return stored;
  if (document.documentElement.dataset.theme === "dark") return "dark";
  return mediaQuery.matches ? "dark" : "light";
};
const updateThemeColorMeta = (theme) => {
  const meta = document.querySelector('meta[name="theme-color"]');
  if (!meta) return;
  const content = theme === "dark" ? "#0B1220" : "#F4F4F4";
  meta.setAttribute("content", content);
};
const applyTheme = (theme, { persist = true } = {}) => {
  const mode = theme === "dark" ? "dark" : "light";
  const root = document.documentElement;
  root.classList.toggle("dark", mode === "dark");
  root.dataset.theme = mode;
  root.style.colorScheme = mode;
  if (persist) {
    try {
      localStorage.setItem(STORAGE_KEY, mode);
    } catch (_err) {
    }
  }
  updateThemeColorMeta(mode);
  document.querySelectorAll("[data-theme-toggle]").forEach((button) => {
    button.setAttribute("aria-pressed", mode === "dark" ? "true" : "false");
    const sun = button.querySelector('[data-theme-icon="light"]');
    const moon = button.querySelector('[data-theme-icon="dark"]');
    if (sun) sun.classList.toggle("hidden", mode !== "light");
    if (moon) moon.classList.toggle("hidden", mode !== "dark");
    const label = button.querySelector("[data-theme-label]");
    if (label) {
      label.textContent = mode === "dark" ? "Switch to light mode" : "Switch to dark mode";
    }
  });
};
const toggleTheme = () => {
  const next = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
  applyTheme(next);
};
const initial = resolveTheme();
applyTheme(initial, { persist: Boolean(readStoredTheme()) });
const bindToggles = () => {
  document.addEventListener(
    "click",
    (event) => {
      const button = event.target.closest("[data-theme-toggle]");
      if (!button) return;
      toggleTheme();
    },
    { passive: true }
  );
};
if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", bindToggles, { once: true });
} else {
  bindToggles();
}
mediaQuery.addEventListener("change", (event) => {
  if (readStoredTheme()) return;
  applyTheme(event.matches ? "dark" : "light", { persist: false });
});
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("searchForm");
  const grid = document.getElementById("carsGrid");
  if (!form || !grid) return;
  const endpoint = (params) => `/api/cars?${params.toString()}`;
  const formatIDR = (amount) => new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0
  }).format(amount || 0);
  function cardTemplate(car) {
    const image = car.image_path ? `/storage/${car.image_path}` : car.image_url || "https://images.unsplash.com/photo-1549924231-f129b911e442?q=80&w=1200&auto=format&fit=crop";
    const transmission = car.transmission || "automatic";
    const seats = car.seats || 5;
    const location = car.location || "";
    const price = car.price_per_day ?? 0;
    const name = car.name;
    return `
			<div class="group overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
				<div class="relative aspect-4/3 overflow-hidden">
					<img src="${image}" alt="${name}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" loading="lazy">
					<div class="pointer-events-none absolute inset-0 bg-linear-to-t from-black/20 to-transparent"></div>
				</div>
				<div class="p-4">
					<div class="flex items-start justify-between gap-3">
						<div>
							<h3 class="text-base font-semibold leading-6">${name}</h3>
							<p class="mt-0.5 text-xs text-gray-500">${(car.type || "").toUpperCase()} • ${transmission.charAt(0).toUpperCase() + transmission.slice(1)}</p>
						</div>
                        <div class="text-right">
                            <div class="text-lg font-bold">${formatIDR(
      price
    )}<span class="text-sm font-medium text-gray-500">/day</span></div>
                        </div>
					</div>
					<div class="mt-3 flex flex-wrap items-center gap-2 text-[11px] text-gray-600 dark:text-gray-300">
						<span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 dark:bg-gray-800">
							<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13v-2a8 8 0 1 0-16 0v2"/><path d="M2 13h20"/><path d="M6 17h.01"/><path d="M10 17h.01"/><path d="M14 17h.01"/><path d="M18 17h.01"/></svg>
							AC
						</span>
						<span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 dark:bg-gray-800">
							<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5-5 5 5"/><path d="M12 19V7"/></svg>
							${transmission.charAt(0).toUpperCase() + transmission.slice(1)}
						</span>
						<span class="inline-flex items-center gap-1 rounded-md bg-gray-100 px-2 py-1 dark:bg-gray-800">
							<svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 7h20M2 17h20M4 7l2 10m12-10l2 10M6 11h12"/></svg>
							${seats} seats
						</span>
					</div>
					<div class="mt-4 flex items-center justify-between">
						<span class="text-[11px] text-gray-500">${location}</span>
						<button class="rounded-lg bg-gray-900 px-3 py-2 text-xs font-semibold text-white hover:bg-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700">Reserve</button>
					</div>
				</div>
			</div>
		`;
  }
  async function loadCars(params) {
    try {
      const url = endpoint(params);
      const res = await fetch(url, {
        headers: { Accept: "application/json" }
      });
      const data = await res.json();
      const cars = data?.data || data;
      if (!Array.isArray(cars)) return;
      grid.innerHTML = cars.map(cardTemplate).join("");
      if (cars.length === 0) {
        grid.innerHTML = `<div class="sm:col-span-2 lg:col-span-3"><div class="rounded-xl border border-gray-200 bg-white p-6 text-center text-sm text-gray-600 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">No cars found. Try adjusting filters.</div></div>`;
      }
    } catch (e) {
      console.error("Failed to load cars", e);
    }
  }
  function getParams() {
    const fd = new FormData(form);
    const p = new URLSearchParams();
    for (const [k, v] of fd.entries()) {
      if (v) p.append(k, v.toString());
    }
    return p;
  }
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const params = getParams();
    loadCars(params);
    const url = `${form.action}?${params.toString()}`;
    window.history.replaceState({}, "", url);
  });
  setInterval(() => loadCars(getParams()), 15e3);
});
