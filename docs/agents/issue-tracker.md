# Local Markdown issue tracker

- Use one directory per feature at `.scratch/<feature-slug>/`.
- Save the spec as `spec.md` in the feature directory.
- Save each ticket in its own file at `issues/<NN>-<slug>.md`, numbered from `01`.
- Record triage state on a `Status:` line near the top of each ticket. Use the values in `triage-labels.md`.
- Append conversation history under `## Comments` at the bottom of the ticket.

To publish a spec or ticket, create its file at the path above. To fetch a ticket, read the referenced file or look up its number in the relevant feature directory.

## Wayfinding

- Keep the effort map at `.scratch/<effort>/map.md` and its child tickets under `.scratch/<effort>/issues/`, using the same numbering convention.
- Put the question in the child ticket body. Use `Type:` for `research`, `prototype`, `grilling`, or `task`.
- Record dependencies as `Blocked by: NN, NN`. A ticket is unblocked when every listed ticket has `Status: resolved`.
- Take the lowest-numbered open, unblocked, unclaimed ticket. Set `Status: claimed` and save before starting.
- To resolve a ticket, append `## Answer`, set `Status: resolved`, and add a summary and link under Decisions-so-far in the map.
